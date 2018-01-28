<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dealer;
use App\DealerType;
use App\Wallet;
use App\Command;
use App\SMSQueue;
use Exception;


class L4DHelper extends Controller
{
    //
    public static $load_api = "api-load4wrd.kpa.ph";

    public static $company_name = "PollyStore";

    public function transaction_number() {
      return date("ymd") . substr(number_format(time() * rand(), 0,'',''), 0, 10);
    }

    public function trans_num() {
      $num = null;
      $w = null;

      do {
        $num = $this->transaction_number();
        $w = Wallet::where('transaction', $num)->first();
      }while($w != null);

      return $num;
    }

    public function one_time_password() {
      return substr(number_format(time() * rand(),0,'',''),0,6);
    }

    public function get_load_command($network, $amount) {

      $q = Command::where('network', (int)$network)->where('custom_cmd', $amount)->first();

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

    public function update_wallet($duid, $description, $amount) {
      $trans = $this->trans_num();

      $s = new Wallet();
      $s->dealer_id = $duid;
      $s->transaction = $trans;
      $s->description = $description;
      $s->amount = $amount;
      $s->type = 0;
      $s->status = 0;

      if($s->save()) {
        return array(
          "status" => 200,
          "transaction" => $trans,
          "last_id" => $s->id
        );
      }

      return array(
        "status" => 500,
        "transaction" => null,
        "last_id" => -1
      );
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

    public function toINT($value) {
      $r = -0;
      try {
        $r = (int)$value;
      }
      catch(\Exception $e) {
        $r = 1;
      }
      return $r;
    }
}
