<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dealer;
use App\DealerType;
use App\Wallet;
use App\Loading;
use App\ProductCode;
use App\SMSQueue;
use DB;
use Exception;


class L4DHelper extends Controller
{
    //
    public static $load_api = "staging.kpa.ph:8066";

    public static $company_name = "PollyStore";

    // static method

    public static function network($value) {
      $net = 0;
      switch ($value) {
        case 'SMART':
          $net = 1;
          break;
        case 'GLOBE':
          $net = 2;
          break;
        default:
          $net = 3;
          break;
      }
      return $net;
    }

    // instance method

    public function transaction_number() {
      return date("ymd") . substr(number_format(time() * rand(), 0,'',''), 0, 10);
    }

    public function trans_num() {
      $num = null;
      $w = null;

      do {
        $num = $this->transaction_number();
        $w = Wallet::where('reference', $num)->first();
      }while($w != null);

      return $num;
    }

    public function one_time_password() {
      return substr(number_format(time() * rand(),0,'',''),0,6);
    }

    public function get_load_command($network, $prod_code) {
      $q = DB::select("
        SELECT * FROM
        tbl_load_product_codes
        WHERE network = {$network}
        AND custom_cmd = '{$prod_code}'
      ");
      $count = COUNT($q);
      return array(
        "status" => $count > 0 ? 200 : 404,
        "data" => $count > 0 ? $q : null
      );
    }

    public function get_wallet_summary($dealer_id) {
      $d_uid = (int)$dealer_id;
      $str = DB::select("
        SELECT
          (SELECT CASE WHEN SUM(amount) > 0 THEN SUM(amount) ELSE 0 END FROM tbl_wallet WHERE dealer_id = {$d_uid} AND type = 1 AND status = 1) AS credits,
          (SELECT CASE WHEN SUM(amount) > 0 THEN SUM(amount) ELSE 0 END FROM tbl_wallet WHERE dealer_id = {$d_uid} AND type = 0 AND status = 1) AS debits,
          (
          	(SELECT CASE WHEN SUM(amount) > 0 THEN SUM(amount) ELSE 0 END FROM tbl_wallet WHERE dealer_id = {$d_uid} AND type = 1 AND status = 1) -
              (SELECT CASE WHEN SUM(amount) > 0 THEN SUM(amount) ELSE 0 END FROM tbl_wallet WHERE dealer_id = {$d_uid} AND type = 0 AND status = 1)
          ) AS available;
      ");

      return array(
        "wallet" => $str
      );
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

    public function add_wallet($duid, $description, $amount) {
      $ref_number = $this->trans_num();

      $s = new Wallet();
      $s->dealer_id = $duid;
      $s->reference = $ref_number;
      $s->description = $description;
      $s->amount = $amount;
      $s->type = 0;
      $s->status = 0;

      if($s->save()) {
        return array(
          "status" => 200,
          "reference" => $ref_number,
          "last_id" => $s->id
        );
      }

      return array(
        "status" => 500,
        "reference" => null,
        "last_id" => -1
      );
    }

    public function add_loading_transaction($ref_number, $network, $transaction, $target, $product_code, $amount) {
      $l = new Loading();
      $l->reference = $ref_number;
      $l->network_provider = $network;
      $l->transaction_number = $transaction;
      $l->target_mobile_number = $target;
      $l->product_code = $product_code;
      $l->amount = $amount;
      $l->status = 1;

      if($l->save()) {
        return array(
          "status" => 200,
          "reference" => $ref_number,
          "last_id" => $l->id
        );
      }

      return array(
        "status" => 500,
        "reference" => null,
        "last_id" => -1
      );
    }

    public function update_wallet($reference, $status = 1) {

      $w = Wallet::where('reference', $reference)
          ->update( ["status" => $status] );

      if($w) {
        return true;
      }

      return false;
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
