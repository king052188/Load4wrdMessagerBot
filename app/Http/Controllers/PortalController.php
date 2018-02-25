<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalController extends Controller
{
    //

    public function Dashboard(Request $request) {

      $type = 1;
      if(IsSet($request->type)) {
        $type = $request->type;
      }

      $data = array(
        "type" => $type
      );

      return view('themes.portal', compact('data'));
    }
}
