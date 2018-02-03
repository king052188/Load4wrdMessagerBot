<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dealer;
use App\DealerType;
use App\Wallet;
use App\SMSQueue;
use App\ProductCode;
use Carbon\Carbon;
use DB;

class L4DBotController extends Controller
{
    public static $CMDPrefix;

    public function __construct () {
      $this::$CMDPrefix = "LC";
    }

    public function verification(Request $request) {
      $company_name = L4DHelper::$company_name;
      $helper = new L4DHelper();

      $fb_id = $request->fb_id;
      $user_mobile = $request->mobile;

      $dealer = DB::select("SELECT * FROM tbl_dealers WHERE facebook_id = '{$fb_id}' OR mobile = '{$user_mobile}';");
      if(COUNT($dealer) > 0) {
        return array(
          'status' => 401,
          'message' => "Oops, mobile number or facebook ID already exists to our system.",
          'facebook_id' => null,
          'user_mobile' => null,
          'one_time_password' => 0
        );
      }

      // send verificatio code
      $otp = (int)$helper->one_time_password();
      $helper->sms_queue(
        $user_mobile,
        $helper->message("otp", $user_mobile, "{$otp} is your {$company_name} confirmation code. Please do not share this code with anyone. Thank You!")
      );

      return array(
        'status' => 200,
        'message' => "success",
        'facebook_id' => $fb_id,
        'user_mobile' => $user_mobile,
        'one_time_password' => $otp
      );
    }

    public function register(Request $request) {
      $helper = new L4DHelper();
      $fb_id = $request->fb_id;
      $user_mobile = $request->mobile;

      $dealer = DB::select("SELECT * FROM tbl_dealers WHERE facebook_id = '{$fb_id}' OR mobile = '{$user_mobile}';");
      if(COUNT($dealer) > 0) {
        return array(
          'status' => 401,
          'message' => "Oops, mobile number or facebook ID already exists to our system."
        );
      }

      $d = new Dealer();
      $d->facebook_id = $fb_id;
      $d->mobile = $user_mobile;
      if($d->save()) {
        $helper->sms_queue(
          $user_mobile,
          $helper->message("welcome", $user_mobile)
        );

        return array(
          'status' => 200,
          'message' => "Thank You for registering, to activate your account.\r\n\r\nPlease type HELP then press enter."
        );
      }

      return array(
        'status' => 500,
        'message' => "Oops, something went wrong."
      );
    }

    public function command_load($request_type = "web", Request $request) {
      $dt = Carbon::now()->toDateTimeString();
      $command = $request->command;
      if($request_type == "web") {
        $fb_id = $request->fb_id;
      }
      else {
         $fb_id = $request->mobile;
      }

      $dealer = DB::select("SELECT * FROM tbl_dealers WHERE facebook_id = '{$fb_id}' OR mobile = '{$fb_id}';");

      if(COUNT($dealer) == 0) {
        return array(
          'status' => 401,
          'message' => "Oops, your facebook ID did not found to our system."
        );
      }

      if (strpos($command, $this::$CMDPrefix) !== false) {
        $commands = explode(" ", $command);
        if(COUNT($commands) > 1 && COUNT($commands) == 2) {
          if($commands[1] == "BAL" || $commands[1] == "Bal" || $commands[1] == "bal") {
            return $this->bal($dealer);
          }
          return $this->wbal();
        }

        if(COUNT($commands) > 2 && COUNT($commands) == 3) {

          // sms command
          if($request_type=="sms") {
            return $this->execute_load_via_sms(
              $dealer,
              $commands
            );
          }

          // web/messenger command
          return $this->execute_load(
            $dealer,
            $commands
          );
        }

        return array(
          'status' => 404,
          'message' => "Invalid command. Please try again."
        );
      }

      return array(
        'status' => 404,
        'message' => "Hello\r\nHow may we help you?"
      );
    }

    // messenger bot or web command

    public function wbal() {
      $helper = new L4DHelper();
      $json = $helper->curl_execute(null, "/balance.aspx");

      $smart = number_format($json["Smart"]["smartBalance"], 2);
      $globe = number_format($json["Globe"]["globeBalance"], 2);
      $sun = number_format($json["Sun"]["sunBalance"], 2);

      $dt = Carbon::now()->toDateTimeString();
      $msg = "Wallet Available as of {$dt}\r\n\r\n";
      $msg .= "SMART {$smart}\r\n";
      $msg .= "GLOBE {$globe}\r\n";
      $msg .= "SUNXX {$sun}";

      return array(
        'status' => 200,
        'message' => $msg
      );

    }

    public function bal($dealer) {
      $helper = new L4DHelper();

      $duid = $dealer[0]->Id;
      $fb_id = $dealer[0]->facebook_id;

      $dt = Carbon::now()->toDateTimeString();
      $json = $helper->get_wallet_summary($duid);
      $wallet = $json["wallet"][0]->available;

      $msg = "Your wallet load is ₱{$wallet} as of {$dt}";

      return array(
        'status' => 200,
        'message' => $msg
      );
    }

    public function execute_load($dealer, $commands) {
      $company_name = L4DHelper::$company_name;
      $helper = new L4DHelper();
      $duid = $dealer[0]->Id;
      $fb_id = $dealer[0]->facebook_id;
      $dealer_mobile = $dealer[0]->mobile;
      $target = $commands[2];
      $code = $commands[1];

      // check network provider
      $network = L4DHelper::prefix($target);
      if($network == "INVALID") {
        return array(
          'status' => 404,
          'message' => "Your target mobile# is not valid. Please try again. Thank You!",
          'facebook_id' => $fb_id,
          'target_mobile' => $target,
          'product_code' => $code,
          'load_amount' => 0,
          'one_time_password' => null
        );
      }

      // product codes
      $product_codes = $helper->get_load_keyword(
        L4DHelper::network($network),
        $code
      );

      if($product_codes["status"] > 200) {
        return array(
          'status' => 404,
          'message' => "Your command is not valid. Please type HELP then press enter.",
          'facebook_id' => $fb_id,
          'target_mobile' => $target,
          'product_code' => $code,
          'load_amount' => 0,
          'one_time_password' => null
        );
      }

      // check the wallet of the member if enough to load
      $dealer_wallets = $helper->get_wallet_summary($dealer[0]->Id);
      $prod_code_keyword = $product_codes["data"][0]->keyword;
      $prod_code_amount = (float)$product_codes["data"][0]->amount;
      $dealer_wallet = (float)$dealer_wallets["wallet"][0]->available;

      // if wallet is below 5 pesos
      if($dealer_wallet <= 5) {
        return array(
          "status" => 401,
          "message" => "Your wallet available is less than ₱5 pesos. Please reload to be able to load.",
          "mobile" => $target,
          "amount" => $prod_code_keyword
        );
      }

      // if amount load grather than wallet of member
      if($prod_code_amount > $dealer_wallet) {
        return array(
          "status" => 402,
          "message" => "Your wallet is not enough to load amounting ₱{$prod_code_amount} pesos. Please reload to be able to load.",
          "mobile" => $target,
          "amount" => $prod_code_keyword
        );
      }

      // update wallet of the member
      $wallet = $helper->add_wallet($duid, "BUY", $prod_code_amount);
      if($wallet["status"] > 200) {
        return array(
          "status" => 403,
          "message" => "Oops. Something went wrong with Telcom. Please try again.",
          "mobile" => $target,
          "amount" => $prod_code_keyword
        );
      }
      $reference = $wallet["reference"];

      $otp = (int)$helper->one_time_password();
      $helper->sms_queue(
        $dealer_mobile,
        $helper->message("otp", $dealer_mobile, "{$otp} is your {$company_name} One-Time-Password or OTP. Please do not share this code with anyone. Thank you!")
      );

      $message = "Your about to load this mobile# {$target} with amount ₱{$prod_code_amount} pesos.\r\n\r\n";
      $message .= "Here is your reference# {$reference} to proceed your request, please type MPIN<space>MPINCode then press enter.\r\n\r\n";
      $message .= "The MPIN has been sent to your mobile#. Please do not share this code with anyone.";

      return array(
        'status' => 200,
        'message' => $message,
        'facebook_id' => $fb_id,
        'reference_number' => $reference,
        'target_mobile' => $target,
        'product_code' => $prod_code_keyword,
        'load_amount' => $prod_code_amount,
        'one_time_password' => $otp
      );
    }

    public function proceed_load_request(Request $request) {
      $helper = new L4DHelper();
      $fb_id = $request->fb_id;
      $reference = $request->reference;
      $target = $request->target;
      $keyword = $request->code;
      $amount = (float)$request->amount;
      $network = L4DHelper::prefix($target);

      $param = "network={$network}&target={$target}&code={$keyword}";
      $load_results = $helper->curl_execute(null, "/execute-load-command.aspx?{$param}");

      if($load_results["status"] == 200) {
        $committed = $load_results["committed"];
        $verified = $load_results["verified"];
        $topup_transaction = $committed["topupSessionID"];

        $w = $helper->update_wallet($reference, 1);
        $l = $helper->add_loading_transaction(
          $reference,
          L4DHelper::network($network),
          $topup_transaction,
          $target,
          $keyword,
          $amount
        );

        $description = "Your request is being processed, reference#: {$reference}\r\n\r\n";
        $description .= "Please wait 3 or 10 seconds for the SMS Notification.\r\n\r\n";
        $description .= "Note: Sometimes the SMS Notification for load depends on the NETWORK.";

        $json = array(
          "status" => 200,
          "message" => $description,
          "mobile" => $target,
          "amount" => $amount
        );
      }
      else {
        $json = array(
          "status" => 500,
          "message" => "Your request did not proceed.",
          "mobile" => $target,
          "amount" => $amount
        );
      }

      return $json;
    }


    // sms command load

    public function execute_load_via_sms($dealer, $commands) {

      $company_name = L4DHelper::$company_name;
      $helper = new L4DHelper();
      $duid = $dealer[0]->Id;
      $fb_id = $dealer[0]->facebook_id;
      $dealer_mobile = $dealer[0]->mobile;
      $target = $commands[2];
      $code = $commands[1];

      // check network provider
      $network = L4DHelper::prefix($target);
      if($network == "INVALID") {
        return array(
          'status' => 404,
          'message' => "Your target mobile# is not valid. Please try again. Thank You!",
          'facebook_id' => $fb_id,
          'target_mobile' => $target,
          'product_code' => $code,
          'load_amount' => 0,
          'one_time_password' => null
        );
      }

      // product codes
      $product_codes = $helper->get_load_keyword(
        L4DHelper::network($network),
        $code
      );

      if($product_codes["status"] > 200) {
        return array(
          'status' => 404,
          'message' => "The product code is not valid. Please try again with a valid product code.",
          'facebook_id' => $fb_id,
          'reference_number' => null,
          'target_mobile' => $target,
          'product_code' => $code,
          'load_amount' => 0,
          'one_time_password' => null
        );
      }

      // check the wallet of the member if enough to load
      $dealer_wallets = $helper->get_wallet_summary($dealer[0]->Id);
      $prod_code_keyword = $product_codes["data"][0]->keyword;
      $prod_code_amount = (float)$product_codes["data"][0]->amount;
      $dealer_wallet = (float)$dealer_wallets["wallet"][0]->available;

      // if wallet is below 5 pesos
      if($dealer_wallet <= 5) {
        return array(
          'status' => 401,
          'message' => "Your wallet available is less than ₱5 pesos. Please reload your wallet to be able to load for all networks.",
          'facebook_id' => $fb_id,
          'reference_number' => null,
          'target_mobile' => $target,
          'product_code' => $code,
          'load_amount' => 0,
          'one_time_password' => null
        );
      }

      // if amount load grather than wallet of member
      if($prod_code_amount > $dealer_wallet) {
        return array(
          'status' => 402,
          'message' => "Your wallet is not enough to load amounting ₱{$prod_code_amount} pesos. Please reload your wallet to be able to load for all networks.",
          'facebook_id' => $fb_id,
          'reference_number' => null,
          'target_mobile' => $target,
          'product_code' => $code,
          'load_amount' => 0,
          'one_time_password' => null
        );
      }

      // update wallet of the member
      $wallet = $helper->add_wallet($duid, "BUY", $prod_code_amount);
      if($wallet["status"] > 200) {
        return array(
          'status' => 403,
          'message' => "Oops. Something went wrong with Telcom/Network. Please try again.",
          'facebook_id' => $fb_id,
          'reference_number' => null,
          'target_mobile' => $target,
          'product_code' => $code,
          'load_amount' => 0,
          'one_time_password' => null
        );
      }
      $reference = $wallet["reference"];

      // $otp = (int)$helper->one_time_password();
      // $helper->sms_queue(
      //   $dealer_mobile,
      //   $helper->message("otp", $dealer_mobile, "{$otp} is your {$company_name} One-Time-Password or OTP. Please do not share this code with anyone. Thank you!")
      // );
      //
      // $message = "Your about to load this mobile# {$target} with amount ₱{$prod_code_amount} pesos.\r\n\r\n";
      // $message .= "Here is your reference# {$reference} to proceed your request, please type CODE<space>One-Time-Password then press enter.\r\n\r\n";
      // $message .= "The OTP or One-Time-Passwrd has been sent to your mobile#. Please do not share this code with anyone.";
      //
      // return array(
      //   'status' => 200,
      //   'message' => $message,
      //   'facebook_id' => $fb_id,
      //   'reference_number' => $reference,
      //   'target_mobile' => $target,
      //   'product_code' => $prod_code_keyword,
      //   'load_amount' => $prod_code_amount,
      //   'one_time_password' => $otp
      // );

      return $this->proceed_load_request_via_sms(
        $fb_id,
        $reference,
        $network,
        $target,
        $prod_code_keyword,
        (float)$prod_code_amount
      );
    }

    public function proceed_load_request_via_sms($fb_id, $reference, $network, $target, $keyword, $amount) {
      $helper = new L4DHelper();
      $param = "network={$network}&target={$target}&code={$keyword}";
      $load_results = $helper->curl_execute(null, "/execute-load-command.aspx?{$param}");

      if($load_results["status"] == 200) {
        $committed = $load_results["committed"];
        $verified = $load_results["verified"];
        $topup_transaction = $committed["topupSessionID"];

        $w = $helper->update_wallet($reference, 1);
        $l = $helper->add_loading_transaction(
          $reference,
          L4DHelper::network($network),
          $topup_transaction,
          $target,
          $keyword,
          $amount
        );

        $description = "Your request is being processed reference#: {$reference}\r\n";
        $description .= "Please wait 3 or 10 seconds for the SMS Notification.\r\n";
        $description .= "Note: Sometimes the SMS Notification for load depends on the NETWORK.";

        $json = array(
          "status" => 200,
          "message" => $description,
          'facebook_id' => $fb_id,
          'reference_number' => $reference,
          'target_mobile' => $target,
          'product_code' => $code,
          'load_amount' => 0,
          'one_time_password' => null
        );
      }
      else {
        $json = array(
          "status" => 500,
          "message" => "Your request with reference#: {$reference} did not proceed. Please try again. Thank You!",
          'facebook_id' => $fb_id,
          'reference_number' => $reference,
          'target_mobile' => $target,
          'product_code' => $code,
          'load_amount' => 0,
          'one_time_password' => null
        );
      }

      return $json;
    }


















    public function verify_load(Request $request) {
      $fb_id = $request->fb_id;
      $network = $request->network;
      $transaction = $request->transaction;

      $dealer = DB::select("SELECT * FROM tbl_dealers WHERE facebook_id = '{$fb_id}' OR mobile = '{$fb_id}';");
      if(COUNT($dealer) == 0) {
        return array(
          'status' => 401,
          'message' => "Oops, your facebook ID did not found in our system."
        );
      }

      $helper = new L4DHelper();
      $data = array(
        "network" => $network,
        "tx" => $transaction
      );

      $param = "network={$network}&tx={$transaction}";
      $json = $helper->curl_execute(null, "/verify.aspx?{$param}");

      if($network == "SMART") {
        return $this->smart_response($request, $json);
      }

      return $data;
    }

    public function smart_response($request, $json) {
      $transaction = $request->transaction;
      $mobile = $request->mobile;
      $amount = (float)$request->amount;

      // return array(
      //   'status' => 201,
      //   'message' => "Need to reverify again."
      // );

      if (strpos($json["ResultCode"], '10') !== false) {
        return array(
          'status' => 201,
          'message' => "Need to reverify again."
        );
      }

      if (strpos($json["ResultCode"], '0000') !== false) {
        if (strpos($json["TransactionStatus"], 'SUCCESSFUL') !== false) {
          if($json["TargetNo"] != $mobile) {
            return array(
              'status' => 401,
              'message' => "Oops, recipient mobile number did not match to the transaction."
            );
          }
          if($json["Amount"] != $amount) {
            return array(
              'status' => 401,
              'message' => "Oops, the load amount did not match to the transaction."
            );
          }
          $msg = "LOAD NOTIFICATION\r\n\r\nTransaction# {$transaction}\r\n\r\nYour load request amount ₱" . $json["Amount"] . " pesos has been loaded to " . $json["TargetNo"] . ". Thank You!";
          return array(
            'status' => 200,
            'message' => $msg,
            'data' => $json
          );
        }
      }

      return array(
        'status' => 500,
        'message' => "Your request was failed. Please try again."
      );
    }
}
