<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dealer;
use App\DealerType;
use App\Wallet;
use App\SMSQueue;
use Carbon\Carbon;
use DB;

class L4DBotController extends Controller
{
    public function __construct () {
    }

    public function verification(Request $request) {
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
        $helper->message("otp", $user_mobile, "PollyStore verification code: {$otp}. Please do not share this code with anyone. Thank You!")
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

    public function command_load(Request $request) {
      $dt = Carbon::now()->toDateTimeString();

      $fb_id = $request->fb_id;
      $command = $request->command;

      $dealer = DB::select("SELECT * FROM tbl_dealers WHERE facebook_id = '{$fb_id}' OR mobile = '{$fb_id}';");

      if(COUNT($dealer) == 0) {
        return array(
          'status' => 401,
          'message' => "Oops, your facebook ID did not found to our system."
        );
      }

      if (strpos($command, 'LOAD') !== false) {

        $commands = explode(" ", $command);

        if(COUNT($commands) > 1 && COUNT($commands) == 2) {
            return $this->wbal();
        }

        if(COUNT($commands) > 2 && COUNT($commands) == 3) {
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

    public function execute_load($dealer, $commands) {
      $helper = new L4DHelper();
      $target = $commands[2];
      $amount = $commands[1];

      $param = "target={$target}&amount={$amount}";
      $load_results = $helper->curl_execute(null, "/SMARTLoad.aspx?{$param}");

      $description = $load_results["commitResultCodeDesc"];
      $topup_id = $load_results["topupSessionID"];

      if (strpos($description, 'Commit Approved And Queued For Processes') !== false) {
        $description = "Your request is being processed.\r\n\r\n";
        $description .= "Your Transaction#: {$topup_id}\r\n\r\n";
        $description .= "Please wait 5 or 20 seconds for the SMS Confirmation.\r\n\r\n";
        $description .= "Note: Sometimes the SMS Confirmation for load depends on the NETWORK.";
      }

      $json = array(
        "status" => 200,
        "message" => $description,
        "topup_id" => $topup_id,
        "mobile" => $target,
        "amount" => $amount
      );
      return $json;
    }

    public function verify_load(Request $request) {
      $fb_id = $request->fb_id;
      $network = $request->network;
      $transaction = $request->transaction;
      $amount = (float)$request->amount;

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
