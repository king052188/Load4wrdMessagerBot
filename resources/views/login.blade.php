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
            .error__inner>.countdown { font-size: 4rem; }
            @media  screen and (max-width: 1300px) {
              .error__inner>h1 { font-size: 5.5rem; }
              .error__inner>h2 { font-size: 1.3rem; }
              .error__inner>.countdown { font-size: 3rem; }
            }
        </style>
    </head>
    <body data-sa-theme="1">
      <div id="app">
        <section class="error">
          <div class="error__inner">
              <h1>{{ config('app.name') }}</h1>
              <h2>Login and start your E-Loading Business!</h2>

              <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <br>
                <h3 class="card-body__title" style="text-align: left;">Mobile</h3>
                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                    <input type="text" id="mobile" name="mobile" class="form-control form-control-lg" placeholder="Mobile" value="{{ old('mobile') }}" required autofocus>

                    @if ($errors->has('mobile'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                    @endif
                    <i class="form-group__bar"></i>
                </div>

                <br>
                <h3 class="card-body__title" style="text-align: left;">Password</h3>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <i class="form-group__bar"></i>
                </div>

                <button type="submit"  class="btn btn-danger btn-block">Login</button>

                <br><br>

                <label>&copy; {{ date('Y') }} {{ config('app.name') }}</label>

              </form>

          </div>
        </section>
      </div>
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
      <script src="//cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
    </body>
</html>
