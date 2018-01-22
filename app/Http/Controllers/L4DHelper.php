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
    public static $load_api = "api-load4wrd.kpa.ph";

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

    public function update_wallet($duid, $transaction, $description, $amount) {
      $s = new SMSQueue();
      $s->dealer_id = $duid;
      $s->transaction = $transaction;
      $s->description = $description;
      $s->amount = $amount;
      $s->type = 0;
      $s->status = 0;
      return $s->save();
    }

    public function curl_execute($data, $path) {
    // Email API
    $url = "http://". $this::$load_api . $path;

    // Array to Json
    $to_json = json_encode($data);

    // Added JSON Header
    $headers = array('Accept: application/json','Content-Type: application/json');

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $to_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = json_decode(curl_exec($ch), true);
    curl_close($ch);
    return $result;
  }

}
