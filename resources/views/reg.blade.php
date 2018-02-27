<?php
  $asset_url = "http://asset-librares.duckdns.org/";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>LoadPortal v1.0</title>

        <!-- Vendor styles -->
        <link rel="stylesheet" href="{{ $asset_url }}vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="{{ $asset_url }}vendors/bower_components/sweetalert2/dist/sweetalert2.min.css">

        <!-- App styles -->
        <link rel="stylesheet" href="{{ $asset_url }}css/app.min.css">
        <style>
            .error__inner {
                background-color: rgba(0, 0, 0, 0.650);
            }
        </style>
    </head>
    <body data-sa-theme="1">
        <section class="error">
            <div class="error__inner">
                <h1>PollyLoad</h1>
                <h2>Sign up to start your own Business!</h2>

                <div class="col-lg-12">
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
                  <p>By click the sign-up button, you agreed to our term and contidion.</p>

                  <button type="button" id="btn_sign_up" class="btn btn-danger btn-block">Sign Up</button>
                  <br><br>
                  <label>&copy; {{ date('Y') }} PollyLoad</label>
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
        <script src="{{ $asset_url }}vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="{{ $asset_url }}vendors/bower_components/popper.js/dist/umd/popper.min.js"></script>
        <script src="{{ $asset_url }}vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="{{ $asset_url }}vendors/bower_components/sweetalert2/dist/sweetalert2.min.js"></script>
        <script>
          $(document).ready(function() {
            $("#btn_sign_up").click(function() {
              var fname = $("#fname").val();
              var lname = $("#lname").val();
              var mobile = $("#mobile").val();
              if(fname == "") {
                alert_box("Warning", "Please enter your firstname.", "warning");
                return false;
              }
              if(lname == "") {
                alert_box("Warning", "Please enter your lastname.", "warning");
                return false;
              }
              if(mobile == "") {
                alert_box("Warning", "Please enter your mobile#.", "warning");
                return false;
              }
              var url = "/api/v1/web/register/" + xtoken;
              var data = { fname : fname, lname : lname, mobile : mobile };
              $.ajax({
                  dataType: 'json',
                  type:'GET',
                  url: url,
                  data: data,
                  beforeSend: function () {
                    $("#btn_sign_up").text("Please wait...");
                  }
              }).done(function(json){
                  if(json.status == 200) {
                    alert_box("Good Job!", json.message, "success");
                    return false;
                  }
                  alert_box("Warning", json.message, "warning");
              });

            })

          })
          function alert_box(title, message, type) {
            swal({
                title: title,
                text: message,
                type: type,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-success',
                background: 'rgba(0, 0, 0, 0.96)'
            })
          }
        </script>
    </body>
</html>
