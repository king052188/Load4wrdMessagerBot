<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class P4DController extends Controller
{
    //
    public function send($fb_id, Request $request) {
      if(!IsSet($request->command)) {
        return array(
          "status" => 404,
          "message" => "message query did not found."
        );
      }

      $helper = new L4DHelper();
      $command = $request->command;
      $commands = explode(" ", $command);
      if(COUNT($commands) < 3) {
        return array(
          'status' => 401,
          'account' => $fb_id,
          'message' => "Oops, invalid command."
        );
      }

      $mobile = $commands[1];
      $prefix = L4DHelper::prefix($mobile);
      if($prefix == "INVALID") {
        return array(
          'status' => 401,
          'account' => $fb_id,
          'message' => "Oops, invalid prefix of mobile number."
        );
      }

      $facebook_user_info = $helper->curl_fb_execute($fb_id);
      if(!IsSet($facebook_user_info["error"])) {
        $user_first_name = "FROM: " . $facebook_user_info["first_name"] . " " . $facebook_user_info["last_name"] . ",\r\nMSG: ";
      }
      else {
        $user_first_name = "FROM: {$fb_id},\r\nMSG: ";
      }

      $message = str_replace("PTXT ", $user_first_name, $command);
      $message = str_replace("{$mobile} ", "", $message);
      $r = $helper->sms_queue($mobile, $message);
      if($r) {
        return array(
          'status' => 200,
          'account' => $fb_id,
          'message' => "Message Send."
        );
      }

      return array(
        'status' => 500,
        'account' => $fb_id,
        'message' => "Sending Failed."
      );
    }
}
