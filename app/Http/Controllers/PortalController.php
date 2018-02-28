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

class PortalController extends Controller
{
    //

    public function verify_mobile($access_token, Request $request) {
      $helper = new L4DHelper();
      $user_mobile = $request->mobile;
      $company_info = $helper->get_company_info($access_token);
      if($company_info == null) {
        return array(
          'status' => 400,
          'account' => $user_mobile,
          'message' => "Oops, Please contact your service provider.",
          'one_time_password' => 0
        );
      }

      $company_id = $company_info->Id;
      $company_name = $company_info->business_name;
      $dealer = DB::select("SELECT * FROM tbl_dealers WHERE company_id = {$company_id} AND mobile = '{$user_mobile}';");
      if(COUNT($dealer) > 0) {
        return array(
          'status' => 401,
          'account' => $user_mobile,
          'message' => "Your mobile number already exists in our system.",
          'one_time_password' => 0
        );
      }

      $otp = (int)$helper->one_time_password();
      $helper->sms_queue(
        $user_mobile,
        $helper->message("otp", $user_mobile, "{$otp} is your {$company_name} verification code. Please do not share this code with anyone. Thank You!")
      );

      return array(
        'status' => 200,
        'account' => $user_mobile,
        'message' => "We have sent a verification code to your mobile.",
        'one_time_password' => $otp
      );
    }

    public function register_web($access_token, Request $request) {
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

      $d = $helper->get_user_info($company_info->Id, $request->mobile, -1, true);
      if(COUNT($d) > 0) {
        return array(
          'status' => 401,
          'account' => $request->mobile,
          'message' => "Mobile number already exists in our system."
        );
      }

      $d = new Dealer();
      $d->company_id = $company_info->Id;;
      $d->firstname = $request->fname;
      $d->lastname = $request->lname;
      $d->mobile = $request->mobile;
      $d->connected_to = 1;

      if($d->save()) {
        $helper->sms_queue(
          $request->mobile,
          $helper->message("welcome", $request->mobile)
        );

        return array(
          'status' => 200,
          'message' => "Thank You for registering!"
        );
      }
      return array(
        'status' => 500,
        'message' => "Oops, something went wrong."
      );
    }

    public function Dashboard(Request $request) {
      $type = 1;
      if(IsSet($request->type)) {
        $type = $request->type;
      }

      $data = array(
        "type" => $type
      );

      return view('portal.dashboard', compact('data'));
    }

    public function Wallet_Buy(Request $request) {
      return view('portal.wallet.buy');
    }

    public function Wallet_Sell(Request $request) {
      return view('portal.wallet.sell');
    }

    public function Wallet_Transaction(Request $request) {
      return view('portal.wallet.transaction');
    }
}
