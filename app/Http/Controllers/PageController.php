<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PageController extends Controller
{
    //
    public function Reg(Request $request) {
      Helper::Seo(
        "Sign Up - Company Name",
        "The Laravel Ecosystem. Revolutionize how you build the web. Instant PHP Platforms On Linode, DigitalOcean, and more. Push to deploy, PHP 7.2, HHVM, queues, and everything you need to launch and deploy amazing Laravel applications. Launch your application in minutes! Forge UI Preview. Homestead. The official ..."
      );
      return view('reg');
    }

}
