<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SEO;

class Helper extends Controller
{
    //
    public static function Seo($title, $description) {
      SEO::setTitle($title);
      SEO::setDescription($description);
      SEO::opengraph()->setUrl('http://pollystore.kpa.ph');
      SEO::setCanonical('http://pollystore.kpa.ph/e-loading');
      SEO::opengraph()->addProperty('type', 'E-Loading');
      SEO::twitter()->setSite('@pollystore.1020');
    }
}
