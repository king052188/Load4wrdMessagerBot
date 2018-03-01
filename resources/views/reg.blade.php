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
        <link rel="stylesheet" href="{{ config('app.asset_url') }}vendors/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="{{ config('app.asset_url') }}vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">
        <link rel="stylesheet" href="{{ config('app.asset_url') }}vendors/bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="{{ config('app.asset_url') }}vendors/bower_components/sweetalert2/dist/sweetalert2.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

        <!-- App styles -->
        <link rel="stylesheet" href="{{ config('app.asset_url') }}css/app.min.css">
        <style>
            .error__inner {
                background-color: rgba(0, 0, 0, 0.7);
            }
            @media  screen and (max-width: 1300px) {
              .error { margin-top: 80px; }
              .error__inner>h1 { font-size: 5.5rem; }
              .error__inner>h2 { font-size: 1.3rem; }
            }
        </style>
    </head>
    <body data-sa-theme="1">
        <section class="error">
            <div class="error__inner">
                <h1>{{ config('app.name') }}</h1>
                <h2>Make your own business using your mobile# or messenger!</h2>

                <div class="tab-container">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#sign-up-tab" role="tab">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#payment-tab" role="tab">Payment</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active fade show" id="sign-up-tab" role="tabpanel">
                          <br>
                          <h3 class="card-body__title" style="text-align: left;">First name</h3>
                          <div class="form-group">
                              <input type="text" id="fname" class="form-control form-control-lg" placeholder="First name" >
                              <i class="form-group__bar"></i>
                          </div>

                          <br>
                          <h3 class="card-body__title" style="text-align: left;">Last name</h3>
                          <div class="form-group">
                              <input type="text" id="lname" class="form-control form-control-lg" placeholder="Last name">
                              <i class="form-group__bar"></i>
                          </div>

                          <br>
                          <h3 class="card-body__title" style="text-align: left;">Mobile#</h3>
                          <div class="form-group">
                              <input type="text" id="mobile" class="form-control form-control-lg" placeholder="Enter your mobile#">
                              <i class="form-group__bar"></i>
                          </div>

                          <br>
                          <p>By clicking sign-up button, you agree to our Terms of Use & Privacy Policy.</p>

                          <button type="button" id="btn_sign_up" class="btn btn-danger btn-block">Sign Up</button>

                          <button id="btn_modal1" class="btn btn-light" data-toggle="modal" data-target="#modal-backdrop-ignore" style="display: none;"></button>
                        </div>
                        <div class="tab-pane fade" id="payment-tab" role="tabpanel">
                            <p style="font-size: 1.2em;">Choose one of our accounts, see below, then go to the nearest 7-Eleven and use the CLIQQ Machine to send your payment to us.</p>

                            <p style="font-size: 1.2em;">
                              If the payment has been made, please take a picture of the receipt, then,
                              send to our facebook page via messenger <a href="https://www.facebook.com/pollystore.1020/" target="_blank">@pollyload</a>
                              Or email us at <a href="mailto:{{ config('app.payment') }}">{{ config('app.payment') }}</a>
                            </p>

                            <br />
                            <h4 class="pull-left">GCASH</h4>
                            <div class="form-group">
                                <input style="text-align: center;" type="text" id="fname" class="form-control form-control-lg" value="09171236547" >
                                <i class="form-group__bar"></i>
                            </div>

                            <h4 class="pull-left">PAYMAYA</h4>
                            <div class="form-group">
                                <input style="text-align: center;" type="text" id="fname" class="form-control form-control-lg" value="4834-4220-2864-2783" >
                                <i class="form-group__bar"></i>
                            </div>

                            <h4 class="pull-left">Coins.ph</h4>
                            <div class="form-group">
                                <input style="text-align: center;" type="text" id="fname" class="form-control form-control-lg" value="33SgKahXNV26cEy7PbTaFCWZ5CiqEuvuW2" >
                                <i class="form-group__bar"></i>
                            </div>

                        </div>
                    </div>

                    <br><br>

                    <label>&copy; {{ date('Y') }} {{ config('app.name') }}</label>
                </div>

            </div>

            <!-- Ignore backdrop click -->
             <div class="modal fade" id="modal-backdrop-ignore" data-backdrop="static" tabindex="-1">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title pull-left">We have sent a verification code to your mobile.</h5>
                         </div>
                         <div class="modal-body">
                           <h3 class="card-body__title" style="text-align: left;">Verification Code</h3>
                           <div class="form-group">
                               <input type="text" id="mpin" class="form-control form-control-lg" placeholder="Verification code I.e: 123456">
                               <i class="form-group__bar"></i>
                           </div>
                         </div>
                         <div class="modal-footer">
                           <!-- <button type="button" class="btn btn-link pull-left" data-dismiss="modal">Cancel</button> -->
                           <button type="button" id="btn_verify" class="btn btn-link">Verify</button>
                         </div>
                     </div>
                 </div>
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
        <script src="{{ config('app.asset_url') }}vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
        <script src="{{ config('app.asset_url') }}vendors/bower_components/sweetalert2/dist/sweetalert2.min.js"></script>
        <script src="{{ asset('/js/jquery.pollyload.js', config('app.ssl')) }}"></script>
    </body>
</html>
