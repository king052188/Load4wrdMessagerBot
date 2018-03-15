<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\DealerType;
use App\Wallet;
use App\SMSQueue;
use App\ProductCode;
use Carbon\Carbon;
use DB;

class L4DBotController extends Controller
{
    public static $CMDPrefix;
    public static $user_first_name = "";

    public function __construct () {
      $this::$CMDPrefix = "LOAD";
    }

    public function verification($tag, $access_token, Request $request) {
      $helper = new L4DHelper();
      $company_info = $helper->get_company_info($access_token);
      if($company_info == null) {
        return array(
          'status' => 400,
          'message' => "Oops, Please contact your service provider.",
          'facebook_id' => null,
          'user_mobile' => null,
          'one_time_password' => 0
        );
      }

      $company_id = $company_info->Id;
      $company_name = $company_info->business_name;
      $fb_id = $request->fb_id;
      $user_mobile = $request->mobile;

      if($tag == "reg") {
        $dealer = DB::select("SELECT * FROM users WHERE company_id = {$company_id} AND (facebook_id = '{$fb_id}' OR mobile = '{$user_mobile}');");
        if(COUNT($dealer) > 0) {
          return array(
            'status' => 401,
            'message' => "Your mobile number or facebook ID already exists in our system.",
            'type' => $tag,
            'facebook_id' => null,
            'user_mobile' => null,
            'one_time_password' => 0
          );
        }
      }
      else {
        $dealer = DB::select("SELECT * FROM users WHERE company_id = {$company_id} AND mobile = '{$user_mobile}';");
        if(COUNT($dealer) == 0) {
          return array(
            'status' => 401,
            'message' => "Your mobile number doest not exists in our system.",
            'type' => $tag,
            'facebook_id' => null,
            'user_mobile' => null,
            'one_time_password' => 0
          );
        }
        if($dealer[0]->facebook_id == $fb_id) {
          return array(
            'status' => 401,
            'message' => "Your facebook ID already exists in our system.",
            'type' => $tag,
            'facebook_id' => null,
            'user_mobile' => null,
            'one_time_password' => 0
          );
        }
      }

      // send verificatio code
      $otp = (int)$helper->one_time_password();
      $helper->sms_queue(
        $user_mobile,
        $helper->message("otp", $user_mobile, "{$otp} is your {$company_name} confirmation code. Please do not share this code with anyone. Thank You!")
      );

      $message = "We have sent a confirmation code to your mobile.\r\n\r\n";
      $message .= "Please type CODE<space>6-digitsCode then press enter\r\n\r\n";
      $message .= "I.e: CODE 123456 then press enter";

      return array(
        'status' => 200,
        'message' => $message,
        'type' => $tag,
        'facebook_id' => $fb_id,
        'user_mobile' => $user_mobile,
        'one_time_password' => $otp
      );
    }

    public function register($tag, $access_token, Request $request) {
      $helper = new L4DHelper();
      $company_info = $helper->get_company_info($access_token);
      $fb_id = $request->fb_id;
      $user_mobile = $request->mobile;

      if($company_info == null) {
        return array(
          'status' => 400,
          'message' => "Oops, Please contact your service provider.",
          'facebook_id' => null,
          'user_mobile' => null,
          'one_time_password' => 0
        );
      }

      if($tag == "tag") {
        $d = User::where("mobile", $user_mobile)
        ->update(
          array("facebook_id" => $fb_id)
        );

        if($d) {
          $helper->sms_queue(
            $user_mobile,
            $helper->message("welcome", $user_mobile)
          );

          return array(
            'status' => 200,
            'message' => "Thank You for registering, to activate your account please ask your agent.\r\n\r\n Or please type HELP then press enter."
          );
        }

        return array(
          'status' => 500,
          'message' => "Oops, something went wrong."
        );
      }

      $d = new User();
      $d->company_id = $company_info->Id;;
      $d->facebook_id = $fb_id;
      $d->mobile = $user_mobile;
      if($d->save()) {
        $helper->sms_queue(
          $user_mobile,
          $helper->message("welcome", $user_mobile)
        );

        return array(
          'status' => 200,
          'message' => "Thank You for registering, to activate your account please ask your agent.\r\n\r\n Or please type HELP then press enter."
        );
      }
      return array(
        'status' => 500,
        'message' => "Oops, something went wrong."
      );
    }

    public function command_keyword($request_type, $access_token, Request $request) {
      $account = $request->account;
      $command = $request->command;
      $isMobile = $request_type == "web" ? false : true;

      $helper = new L4DHelper();
      $company_info = $helper->get_company_info($access_token);
      if($company_info == null) {
        return array(
          'status' => 400,
          'account' => $account,
          'message' => "Oops, Please contact your service provider.",
        );
      }

      $dealer = $helper->get_user_info($company_info->Id, $account, 1, $isMobile);
      if($dealer == null) {
        return array(
          'status' => 401,
          'account' => $account,
          'message' => "{$this::$user_first_name}your Mobile or facebook ID did not found in our system."
        );
      }

      if (strpos($command, 'ACT') !== false) {
        $commands = explode(" ", $command);
        return $this->activate(
          $company_info,
          $dealer,
          $commands
        );
      }
      else if (strpos($command, 'REG') !== false) {
        $commands = explode(" ", $command);
        return $this->reg(
          $company_info,
          $dealer,
          $commands
        );
      }
      else if (strpos($command, 'BAL') !== false) {
        return $this->bal(
          $company_info,
          $dealer
        );
      }
      else if (strpos($command, 'WBL') !== false) {
        return $this->wbal($dealer);
      }
      else if (strpos($command, 'WALLET') !== false) {
        $commands = explode(" ", $command);
        return $this->wallet(
          $company_info,
          $dealer,
          $commands
        );
      }
      else if (strpos($command, 'LOAD') !== false) {
        $commands = explode(" ", $command);
        // is sms command
        if($isMobile) {
          return $this->execute_load_via_sms(
            $company_info,
            $dealer,
            $commands
          );
        }
        // is web/messenger command
        return $this->execute_load(
          $company_info,
          $dealer,
          $commands
        );
      }
      else if (strpos($command, 'PROCEED') !== false) {
        $commands = explode(" ", $command);
        return $this->proceed_load_request(
          $company_info,
          $dealer,
          $commands
        );
      }

      return array(
        'status' => 404,
        'account' => $account,
        'message' => "{$this::$user_first_name}\r\nHow may we help you?"
      );
    }

    public function reg($company_info, $dealer, $commands) {
      $helper = new L4DHelper();
      if(COUNT($commands) < 3) {
        return array(
          'status' => 401,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}invalid command."
        );
      }

      $type = $commands[1];
      $mobile = $commands[2];

      $new_member = $helper->get_user_info($company_info->Id, $mobile, 1, true);
      if(COUNT($new_member) > 0) {
        return array(
          'status' => 401,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}mobile number already exists in our system."
        );
      }

      $type = $helper->get_type_info($company_info->Id, $type);
      if($type == null) {
        return array(
          'status' => 401,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}the membeship type is not valid. Please try again with a valid type"
        );
      }

      if($type->Id >= $dealer->type) {
        $d = new User();
        $d->company_id = $company_info->Id;
        $d->mobile = $mobile;
        $d->connected_to = $dealer->uid;
        $d->type = $type->Id;
        if($d->save()) {
          $helper->sms_queue(
            $mobile,
            $helper->message("welcome", $mobile)
          );

          return array(
            'status' => 200,
            'account' => $dealer->account,
            'message' => "{$this::$user_first_name}you have successfully registered this mobile# {$mobile}. Thank You!"
          );
        }

        return array(
          'status' => 500,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}failed to register this mobile# {$mobile}.. Please try again. Thank You!"
        );
      }

      return array(
        'status' => 500,
        'account' => $dealer->account,
        'message' => "{$this::$user_first_name}you are now allowed to register {$type->description} as type. Please try again. Thank You!"
      );
    }

    public function activate($company_info, $dealer, $commands) {
      $helper = new L4DHelper();

      if(COUNT($commands) < 3) {
        return array(
          'status' => 401,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}invalid command."
        );
      }

      $pin = $commands[1];
      $mobile = $commands[2];

      if($pin != "2120") {
        return array(
          'status' => 401,
          'account' => $account,
          'message' => "{$this::$user_first_name}invalid Admin PIN."
        );
      }

      $reseller = $helper->get_user_info($company_info->Id, $mobile, -1, true);

      if($reseller == null) {
        return array(
          'status' => 401,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}the mobile you are trying to activate did not found in our system."
        );
      }

      if($reseller->status > 0) {
        return array(
          'status' => 401,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}the mobile you are trying to activate is already activated."
        );
      }

      $d = User::where("Id", $reseller->uid)
      ->update(
        array("status" => 1)
      );

      if($d) {
        $message = "Congrats, your mobile# has been activated and good to go for loading business. Thank You!";
        $helper->sms_queue(
          $mobile,
          $helper->message("otp", $mobile, $message)
        );

        return array(
          'status' => 200,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}you have successfully activate this mobile# {$mobile}. Thank You!"
        );
      }

      return array(
        'status' => 500,
        'account' => $dealer->account,
        'message' => "{$this::$user_first_name}failed to link your messenger. Please try again. Thank You!"
      );

    }

    public function wbal($dealer) {
      $helper = new L4DHelper();
      $json = $helper->curl_execute(null, "/balance.aspx");

      $smart = number_format($json["Smart"]["smartBalance"], 2);
      $globe = number_format($json["Globe"]["globeBalance"], 2);
      $sun = number_format($json["Sun"]["sunBalance"], 2);

      $dt = Carbon::now()->toDateTimeString();
      $msg = "{$this::$user_first_name}Wallet Available as of {$dt}\r\n\r\n";
      $msg .= "SMART {$smart}\r\n";
      $msg .= "GLOBE {$globe}\r\n";
      $msg .= "SUNXX {$sun}";

      return array(
        'status' => 200,
        'account' => $dealer->account,
        'message' => $msg
      );
    }

    public function bal($company_info, $dealer) {
      $helper = new L4DHelper();
      $dt = Carbon::now()->toDateTimeString();
      $json = $helper->get_wallet_summary($dealer->uid);
      $wallet = $json["wallet"][0]->available;
      $amt = number_format($wallet, 2, ".", ",");
      $msg = "{$this::$user_first_name}Your wallet load is {$amt} as of {$dt}.";
      return array(
        'status' => 200,
        'account' => $dealer->account,
        'message' => $msg
      );
    }

    public function wallet($company_info, $dealer, $commands) {

      $dt = Carbon::now()->toDateTimeString();
      $helper = new L4DHelper();
      $company_id = $company_info->Id;
      $company_name = $company_info->business_name;

      $dealer_wallet = $helper->get_wallet_summary($dealer->uid);
      $available = (float)$dealer_wallet["wallet"][0]->available;
      if(COUNT($commands) < 3) {
        return array(
          'status' => 401,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}invalid command."
        );
      }

      $amount = (float)$commands[1];
      $target = $commands[2];

      if($amount <=0) {
        return array(
          'status' => 404,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}\r\nInvalid amount."
        );
      }

      $recipient = $helper->get_user_info($company_id, $target, 1, true);
      if($recipient == null) {
        return array(
          'status' => 401,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}your trying to transfer load does not exists in our system."
        );
      }

      if($dealer->ontop_percentage > 0) {
        if($recipient->ontop_percentage > 0) {
          $ontop_percentage = $dealer->ontop_percentage - $recipient->ontop_percentage; // get dealer ontop
          $ontop_percentage = $dealer->ontop_percentage - $ontop_percentage; // get recipient ontop
          $ontop_amount =  $amount * $ontop_percentage;
          $amount = $amount + $ontop_amount;
        }
      }
      else {
        if($recipient->ontop_percentage > 0) {
          $ontop_percentage = $recipient->ontop_percentage;
          $ontop_amount =  $amount * $ontop_percentage;
          $amount = $amount + $ontop_amount;
        }
      }

      if($dealer->uid == $recipient->uid) {
        return array(
          "status" => 402,
          'account' => $dealer->account,
          "message" => "{$this::$user_first_name}you cannot transfer your account.",
        );
      }

      if($amount > $available) {
        return array(
          "status" => 402,
          'account' => $dealer->account,
          "message" => "{$this::$user_first_name}Your wallet is not enough to transfer P{$amount} pesos.",
        );
      }

      $ref_number = $helper->trans_num();
      $results = $helper->add_wallet(
        $dealer->uid,
        $ref_number,
        "TRANSFER DEBIT",
        $amount,
        0
      );

      if($results["status"] == 200) {
        $results = $helper->add_wallet(
          $recipient->uid,
          $ref_number,
          "TRANSFER CREDIT",
          $amount,
          1
        );

        if($results["status"] == 200) {
          $amt = number_format($amount, 2, ".", ",");
          $msg = "P{$amt} pesos have been loaded to your wallet, reference# {$ref_number} date {$dt}. Thank you!";
          $helper->sms_queue(
            $target,
            $helper->message("otp", $target, $msg)
          );

          return array(
            "status" => 200,
            'account' => $dealer->account,
            "message" => "{$this::$user_first_name}you have transfered P{$amt} pesos to mobile# {$target}.",
          );
        }

        return array(
          "status" => 500,
          'account' => $dealer->account,
          "message" => "{$this::$user_first_name}something went wrong. Please try again.",
        );
      }

      return array(
        "status" => 503,
        'account' => $dealer->account,
        "message" => "{$this::$user_first_name}something went wrong. Please try again.",
      );
    }

    public function execute_load($company_info, $dealer, $commands) {
      $company_name = $company_info->business_name;
      $helper = new L4DHelper();

      $code = $commands[1];
      $target = $commands[2];

      // check network provider
      $network = L4DHelper::prefix($target);
      if($network == "INVALID") {
        return array(
          'status' => 404,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}your target mobile# is not valid. Please try again. Thank You!",
          'command' => null
        );
      }

      // product codes
      $product_codes = $helper->get_load_keyword(
        L4DHelper::network($network),
        $code,
        "custom"
      );

      if($product_codes["status"] > 200) {
        return array(
          'status' => 404,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}your command is not valid. Please type HELP then press enter.",
          'command' => null
        );
      }

      // check the wallet of the member if enough to load
      $dealer_wallets = $helper->get_wallet_summary($dealer->uid);
      $prod_code_keyword = $product_codes["data"][0]->keyword;
      $prod_code_amount = (float)$product_codes["data"][0]->amount;
      $dealer_wallet = (float)$dealer_wallets["wallet"][0]->available;

      // if wallet is below 5 pesos
      if($dealer_wallet <= 5) {
        return array(
          "status" => 401,
          'account' => $dealer->account,
          "message" => "{$this::$user_first_name}your wallet available is less than P5 pesos. Please reload to be able to load.",
          'command' => null
        );
      }

      // if amount load grather than wallet of member
      if($prod_code_amount > $dealer_wallet) {
        return array(
          "status" => 402,
          'account' => $dealer->account,
          "message" => "{$this::$user_first_name}your wallet is not enough to load amounting P{$prod_code_amount} pesos. Please reload to be able to load.",
          'command' => null
        );
      }

      $otp = (int)$helper->one_time_password();
      $helper->sms_queue(
        $dealer->mobile,
        $helper->message("otp", $dealer->mobile, "{$otp} is your {$company_name} One-Time-Password or OTP. Please do not share this code with anyone. Thank you!")
      );

      $message = "{$this::$user_first_name}your load request for this mobile# {$target} with amount P{$prod_code_amount} pesos.\r\n\r\n";
      $message .= "To proceed your request, please type OTP<space>6digitsCode then press enter.\r\n\r\n";
      $message .= "The OTP or One-Time-Password has been sent to your mobile#. Please do not share the code with anyone.";

      return array(
        'status' => 200,
        'account' => $dealer->account,
        'message' => $message,
        'command' => array(
          'mobile' => $target,
          'code' => $code,
          'product_code' => $prod_code_keyword,
          'amount' => $prod_code_amount,
          'one_time_password' => $otp
        )
      );
    }

    public function proceed_load_request($company_info, $dealer, $commands) {
      $helper = new L4DHelper();
      if(COUNT($commands) < 3) {
        return array(
          'status' => 401,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}invalid command."
        );
      }

      $code = $commands[1];
      $target = $commands[2];
      $network = L4DHelper::prefix($target);

      // product codes
      $product_codes = $helper->get_load_keyword(
        L4DHelper::network($network),
        $code,
        "custom"
      );
      $prod_code_keyword = $product_codes["data"][0]->keyword;
      $prod_code_amount = (float)$product_codes["data"][0]->amount;

      $load_log = $helper->add_load_logs($dealer->uid, "DEBIT", $prod_code_amount);
      if($load_log["status"] > 200) {
        return array(
          'status' => 403,
          'account' => $dealer->account,
          'message' => "Oops. Something went wrong with Telcom/Network. Please try again."
        );
      }
      $reference = $load_log["reference"];

      sleep(1);

      return $this->proceed_load_request_via_sms(
        $dealer,
        $reference,
        $network,
        $target,
        $prod_code_keyword,
        (float)$prod_code_amount
      );
    }

    // sms command load

    public function execute_load_via_sms($company_info, $dealer, $commands) {

      $helper = new L4DHelper();
      if(COUNT($commands) < 3) {
        return array(
          'status' => 401,
          'account' => $dealer->account,
          'message' => "{$this::$user_first_name}invalid command."
        );
      }

      $code = $commands[1];
      $target = $commands[2];

      // check network provider
      $network = L4DHelper::prefix($target);
      if($network == "INVALID") {
        return array(
          'status' => 404,
          'account' => $dealer->account,
          'message' => "Your target mobile# is not valid. Please try again. Thank You!"
        );
      }

      // product codes
      $product_codes = $helper->get_load_keyword(
        L4DHelper::network($network),
        $code,
        "custom"
      );

      if($product_codes["status"] > 200) {
        return array(
          'status' => 404,
          'account' => $dealer->account,
          'message' => "The product code is not valid. Please try again with a valid product code."
        );
      }

      // check the wallet of the member if enough to load
      $dealer_wallets = $helper->get_wallet_summary($dealer->uid);
      $prod_code_keyword = $product_codes["data"][0]->keyword;
      $prod_code_amount = (float)$product_codes["data"][0]->amount;
      $dealer_wallet = (float)$dealer_wallets["wallet"][0]->available;

      // if wallet is below 5 pesos
      if($dealer_wallet <= 5) {
        return array(
          'status' => 401,
          'account' => $dealer->account,
          'message' => "Your wallet available is less than P5 pesos. Please reload your wallet to be able to load for all networks."
        );
      }

      // if amount load grather than wallet of member
      if($prod_code_amount > $dealer_wallet) {
        return array(
          'status' => 402,
          'account' => $dealer->account,
          'message' => "Your wallet is not enough to load amounting P{$prod_code_amount} pesos. Please reload your wallet to be able to load for all networks.",
        );
      }

      // update wallet of the member
      $load_log = $helper->add_load_logs($dealer->uid, "DEBIT", $prod_code_amount);
      if($load_log["status"] > 200) {
        return array(
          'status' => 403,
          'account' => $dealer->account,
          'message' => "Oops. Something went wrong with Telcom/Network. Please try again."
        );
      }
      $reference = $load_log["reference"];

      sleep(1);

      return $this->proceed_load_request_via_sms(
        $dealer,
        $reference,
        $network,
        $target,
        $prod_code_keyword,
        (float)$prod_code_amount
      );
    }

    public function proceed_load_request_via_sms($dealer, $reference, $network, $target, $keyword, $amount) {

      if($network!="GLOBE") {
        $r = $this->proceed_load_request_remitbox($dealer, $reference, $network, $target, $keyword, $amount);
        return $r;
      }

      $helper = new L4DHelper();
      $param = "network={$network}&target={$target}&code={$keyword}";
      $load_results = $helper->curl_execute(null, "/execute-load-command.aspx?{$param}");

      sleep(1);

      if($load_results["status"] == 200) {
        $committed = $load_results["committed"];
        $verified = $load_results["verified"];
        $topup_transaction = $committed["topupSessionID"];

        // update load logs
        $logs = $helper->update_loadlogs($reference, 1);

        // add transaction into wallet
        $w = $helper->add_wallet($dealer->uid, $reference, "DEBIT", $amount);

        // add loading transaction
        $l = $helper->add_loading_transaction(
          $reference,
          L4DHelper::network($network),
          $topup_transaction,
          $target,
          $keyword,
          $amount
        );

        $description = "You have been loaded this {$target} with amount {$amount} reference#: {$reference}\r\n";
        $description .= "Please wait more or less 3 seconds for the SMS Notification.\r\n";

        $json = array(
          "status" => 200,
          'account' => $dealer->account,
          "message" => $description,
        );
      }
      else {
        $json = array(
          "status" => 500,
          'account' => $dealer->account,
          "message" => "Your request with reference#: {$reference} did not proceed. Please try again. Thank You!"
        );
      }

      return $json;
    }

    public function proceed_load_request_remitbox($dealer, $reference, $network, $target, $keyword, $amount) {
      $helper = new L4DHelper();
      $remitbox = $helper->curl_execute_remitbox($target, $keyword, $reference);

      if (strpos($remitbox["message"], 'Transaction successful') !== false) {

        $topup_transaction = $remitbox["referenceNumber"];

        // update load logs
        $logs = $helper->update_loadlogs($reference, 1);

        // add transaction into wallet
        $w = $helper->add_wallet($dealer->uid, $reference, "DEBIT", $amount);

        // add loading transaction
        $l = $helper->add_loading_transaction(
          $reference,
          L4DHelper::network($network),
          $topup_transaction,
          $target,
          $keyword,
          $amount
        );

        $description = "You have been loaded this {$target} with amount {$amount} reference#: {$reference}\r\n";

        $json = array(
          "status" => 200,
          'account' => $dealer->account,
          "message" => $description,
        );
      }

      else {
        $json = array(
          "status" => 500,
          'account' => $dealer->account,
          "message" => $remitbox["message"] . " Reference#: {$reference}. Please try again. Thank You!"
        );
      }
      return $json;

    }


















    public function verify_load(Request $request) {
      $fb_id = $request->fb_id;
      $network = $request->network;
      $transaction = $request->transaction;

      $dealer = DB::select("SELECT * FROM users WHERE facebook_id = '{$fb_id}' OR mobile = '{$fb_id}';");
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
          $msg = "LOAD NOTIFICATION\r\n\r\nTransaction# {$transaction}\r\n\r\nYour load request amount P" . $json["Amount"] . " pesos has been loaded to " . $json["TargetNo"] . ". Thank You!";
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
