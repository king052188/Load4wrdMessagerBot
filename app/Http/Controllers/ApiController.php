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

class ApiController extends Controller
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
      $dealer = DB::select("SELECT * FROM users WHERE company_id = {$company_id} AND mobile = '{$user_mobile}';");
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

      $user_password = (int)$helper->one_time_password();
      $hash_password = bcrypt($user_password);

      $d = new User();
      $d->company_id = $company_info->Id;
      $d->firstname = $request->fname;
      $d->lastname = $request->lname;
      $d->mobile = $request->mobile;
      $d->password = $hash_password;
      $d->connected_to = 1;

      if($d->save()) {
        $appname = Helper::Config("name");
        $dealer_name = $request->fname;
        $msg = array(
          "1/4 Congrats {$dealer_name}, you are now registered. Thank You!",
          "2/4 Your password is: {$user_password}. Please do not share with anyone your password.",
          "3/4 To activate your account and start loading, on the sign-up page, click the tab payment.",
          "4/4 For more details, please like our FB page http://bit.ly/2GVmufB or email us at payment@pollyload.com"
        );

        for($i = 0; $i < COUNT($msg); $i++) {
          $helper->sms_queue(
            $request->mobile,
            $helper->message("otp", $request->mobile, $msg[$i])
          );
        }

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
}
