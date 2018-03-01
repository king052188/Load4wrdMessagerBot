<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PageController extends Controller
{
    //

    public function Soon(Request $request) {
      $appname = Helper::Config("name");

      Helper::Seo(
        "Home - {$appname}",
        "The {$appname} Ecosystem. Revolutionize how you load the mobile#. Instant E-LOAD Platforms On SMART, GLOBE, SUN and more. Push to command, SMS, Messenger and {$appname} Portal..."
      );
      return view('soon');
    }

    public function Login(Request $request) {
      $appname = Helper::Config("name");

      Helper::Seo(
        "Home - {$appname}",
        "The {$appname} Ecosystem. Revolutionize how you load the mobile#. Instant E-LOAD Platforms On SMART, GLOBE, SUN and more. Push to command, SMS, Messenger and {$appname} Portal..."
      );
      return view('login');
    }

    public function Reg(Request $request) {
      $appname = Helper::Config("name");

      Helper::Seo(
        "Sign Up - {$appname}",
        "The {$appname} Ecosystem. Revolutionize how you load the mobile#. Instant E-LOAD Platforms On SMART, GLOBE, SUN and more. Push to command, SMS, Messenger and {$appname} Portal..."
      );
      return view('reg');
    }

}
