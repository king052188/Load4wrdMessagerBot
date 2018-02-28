<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {!! SEO::generate() !!}
        <meta content="https://scontent.fmnl8-1.fna.fbcdn.net/v/t1.0-1/28277198_150604555609354_8859755462259764624_n.jpg?oh=5f886d861ba946707b81577c80dafba4&oe=5B0B88F7" property="og:image" />
        <meta content="PollyLoad" property="og:site_name" />

        <link rel="apple-touch-icon" href="https://scontent.fmnl8-1.fna.fbcdn.net/v/t1.0-1/28277198_150604555609354_8859755462259764624_n.jpg?oh=5f886d861ba946707b81577c80dafba4&oe=5B0B88F7">
        <link rel="shortcut icon" type="image/png" href="https://scontent.fmnl8-1.fna.fbcdn.net/v/t1.0-1/28277198_150604555609354_8859755462259764624_n.jpg?oh=5f886d861ba946707b81577c80dafba4&oe=5B0B88F7"/>

        <!-- Vendor styles -->
        <link rel="stylesheet" href="{{ config('app.asset_url') }}vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">

        <!-- App styles -->
        <link rel="stylesheet" href="{{ config('app.asset_url') }}css/app.min.css">
        <style>
            .error__inner {
                background-color: rgba(0, 0, 0, 0.7);
            }
        </style>
    </head>
    <body data-sa-theme="1">
        <section class="error">
            <div class="error__inner">
                <h1>{{ config('app.name') }}</h1>
                <h2>We'll be here soon with our new awesome site!</h2>
            </div>
        </section>
        <!-- Older IE warning message -->
            <!--[if IE]>
                <div class="ie-warning">
                    <h1>Warning!!</h1>
                    <p>You are using an outdated version of Internet Explorer, please upgrade to any of the following web browsers to access this website.</p>

                    <div class="ie-warning__downloads">
                        <a href="http://www.google.com/chrome">
                            <img src="img/browsers/chrome.png" alt="">
                        </a>

                        <a href="https://www.mozilla.org/en-US/firefox/new">
                            <img src="img/browsers/firefox.png" alt="">
                        </a>

                        <a href="http://www.opera.com">
                            <img src="img/browsers/opera.png" alt="">
                        </a>

                        <a href="https://support.apple.com/downloads/safari">
                            <img src="img/browsers/safari.png" alt="">
                        </a>

                        <a href="https://www.microsoft.com/en-us/windows/microsoft-edge">
                            <img src="img/browsers/edge.png" alt="">
                        </a>

                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="img/browsers/ie.png" alt="">
                        </a>
                    </div>
                    <p>Sorry for the inconvenience!</p>
                </div>
            <![endif]-->
        <!-- Javascript -->
        <!-- Vendors -->
        <script src="{{ config('app.asset_url') }}vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="{{ config('app.asset_url') }}vendors/bower_components/popper.js/dist/umd/popper.min.js"></script>
        <script src="{{ config('app.asset_url') }}vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>
