<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessengerController extends Controller
{
    //
    public function send($fb_id, Request $request) {
      if(!IsSet($request->message)) {
        return array(
          "status" => 404,
          "message" => "message query did not found."
        );
      }
      $helper = new L4DHelper();
      return $helper->messenger_send($fb_id, $request->message);
    }
}
