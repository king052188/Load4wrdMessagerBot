<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SEO;

class Helper extends Controller
{
    //
    public static function Config($name) {
      $config = config('app.' . $name);
      return $config;
    }

    public static function Seo($title, $description) {

      $https = "http://";
      if(Helper::Config("ssl")) {
        $https = "https://";
      }
      $domain = $https . Helper::Config("domain");

      SEO::setTitle($title);
      SEO::setDescription($description);
      SEO::opengraph()->setUrl($domain);
      SEO::setCanonical($domain . "/load-to-all-networks");
      SEO::opengraph()->addProperty('type', 'Product, Services, Eloading, ELoad, Load All Networks');
      SEO::twitter()->setSite('@PollyLoad');
    }
}
