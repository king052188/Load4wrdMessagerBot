<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dealer;
use App\DealerType;
use App\Wallet;
use App\SMSQueue;


class L4DHelper extends Controller
{
    //
    public static $company_name = "PollyStore";

    public function one_time_password() {
      return substr(number_format(time() * rand(),0,'',''),0,6);
    }

    public function message($title, $mobile, $customize = null) {
      switch ($title) {
        case 'welcome':
          return "Welcome to {$this::$company_name}, you are now successfully registered.";
        case 'otp':
          return $customize;
      }
    }

    public function sms_queue($mobile, $message) {
      $s = new SMSQueue();
      $s->company_uid = 4;
      $s->user_id = $mobile;
      $s->user_ip_address = 0;
      $s->mobile = $mobile;
      $s->message = $message;
      $s->status = 0;
      return $s->save();
    }
}
