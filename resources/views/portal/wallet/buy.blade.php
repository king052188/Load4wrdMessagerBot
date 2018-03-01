@extends('themes.portal')

@section('css')
<link rel="stylesheet" href="{{ config('app.asset_url') }}vendors/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="{{ config('app.asset_url') }}vendors/bower_components/sweetalert2/dist/sweetalert2.min.css">
@stop
@section('content')
  <header class="content__title">
      <h2>Buy Wallet Load</h2>
      <small>Welcome to the unique SuperAdmin web app experience!</small>
  </header>

  <div class="row quick-stats">
      <div class="col-sm-6 col-md-3">
          <div class="quick-stats__item">
              <div class="quick-stats__info">
                  <h2>₱987,459</h2>
                  <small>Wallet Credits</small>
              </div>

              <div class="quick-stats__chart peity-bar">6,4,8,6,5,6,7,8,3,5,9</div>
          </div>
      </div>

      <div class="col-sm-6 col-md-3">
          <div class="quick-stats__item">
              <div class="quick-stats__info">
                  <h2>₱356,785</h2>
                  <small>Wallet Debits</small>
              </div>

              <div class="quick-stats__chart peity-bar">4,7,6,2,5,3,8,6,6,4,8</div>
          </div>
      </div>

      <div class="col-sm-6 col-md-3">
          <div class="quick-stats__item">
              <div class="quick-stats__info">
                  <h2>₱630,674</h2>
                  <small>Available Wallet</small>
              </div>

              <div class="quick-stats__chart peity-bar">9,4,6,5,6,4,5,7,9,3,6</div>
          </div>
      </div>

      <div class="col-sm-6 col-md-3">
          <div class="quick-stats__item">
              <div class="quick-stats__info">
                  <h2>50 / 200</h2>
                  <small>Total Referrals</small>
              </div>

              <div class="quick-stats__chart peity-bar">5,6,3,9,7,5,4,6,5,6,4</div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
                <h4 class="card-title">Buy Wallet Load</h4>
                <h6 class="card-subtitle">Basic Textual inputs with different sizes by height and column.</h6>

                <h3 class="card-body__title">Mobile#</h3>
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Enter your mobile#" value="09171236987" disabled>
                    <i class="form-group__bar"></i>
                </div>

                <br>
                <h3 class="card-body__title">Amount</h3>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">₱</span>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter amount">
                            <i class="form-group__bar"></i>
                        </div>
                        <span class="input-group-addon">.00</span>
                    </div>
                    <i class="form-group__bar"></i>
                </div>

                <br>
                <h3 class="card-body__title">Sent Type</h3>
                <div class="form-group">
                    <div class="form-group">
                      <select id="sendType" class="select2" data-minimum-results-for-search="Infinity">
                        <option value="0">-- Select --</option>
                        <option value="GCASH:09177715380">7-Eleven GCASH</option>
                        <option value="PAYMAYA:4834-4220-2864-2783">7-Eleven PAYMAYA</option>
                        <option value="COINS.ph:33SgKahXNV26cEy7PbTaFCWZ5CiqEuvuW2">7-Eleven Coins.ph</option>
                      </select>
                    </div>
                    <i class="form-group__bar"></i>
                </div>

                <br>
                <h3 class="card-body__title">Account#</h3>
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="sendAccount" placeholder="Account#">
                    <i class="form-group__bar"></i>
                </div>

                <button type="button" class="btn btn-danger btn-block" id="sa-success">Reload</button>
            </div>
          </div>
      </div>

      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
              <h4 class="card-title">Wallet Transactions</h4>
              <h6 class="card-subtitle">Your Latest 10 Transactions</h6>
          </div>
          <div class="listview">
              <div class="listview__item">
                  <label class="custom-control custom-control--char todo__item">
                      <input class="custom-control-input" type="checkbox" value="" checked disabled>
                      <span class="custom-control--char__helper"><i>F</i></span>
                      <div>
                          <span>Buying Wallet Load worth of P100,000.00</span>
                          <small>Today at 8.30 AM</small>
                      </div>

                      <div class="listview__attrs">
                          <span>COMPLETED</span>
                          <span>GCASH</span>
                      </div>
                  </label>

                  <div class="actions listview__actions">
                      <div class="dropdown actions__item">
                          <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                          <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="">Update</a>
                              <a class="dropdown-item" href="">Cancel</a>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="listview__item">
                  <label class="custom-control custom-control--char todo__item">
                      <input class="custom-control-input" type="checkbox" value="" checked disabled>
                      <span class="custom-control--char__helper"><i>N</i></span>
                      <div>
                          <span>Buying Wallet Load worth of 1,900 pesos</span>
                          <small>Today at 12.30 PM</small>
                      </div>

                      <div class="listview__attrs">
                          <span>COMPLETED</span>
                          <span>COINS.PH</span>
                      </div>
                  </label>

                  <div class="actions listview__actions">
                      <div class="dropdown actions__item">
                          <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="">Update</a>
                            <a class="dropdown-item" href="">Cancel</a>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="listview__item">
                  <label class="custom-control custom-control--char todo__item">
                      <input class="custom-control-input" type="checkbox" value="" checked disabled>
                      <span class="custom-control--char__helper"><i>C</i></span>
                      <div class="todo__info">
                          <span>Buying Wallet Load worth of 3,200 pesos</span>
                          <small>Tomorrow at 10.30 AM</small>
                      </div>

                      <div class="listview__attrs">
                          <span>CANCELED</span>
                          <span>PAYMAYA</span>
                      </div>
                  </label>

                  <div class="actions listview__actions">
                      <div class="dropdown actions__item">
                          <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="">Update</a>
                            <a class="dropdown-item" href="">Cancel</a>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="listview__item">
                  <label class="custom-control custom-control--char todo__item">
                      <input class="custom-control-input" type="checkbox" value="" disabled>
                      <span class="custom-control--char__helper"><i>I</i></span>
                      <div class="todo__info">
                          <span>Buying Wallet Load worth of 2,900 pesos</span>
                          <small>05/08/2017 at 08.00 AM</small>
                      </div>

                      <div class="listview__attrs">
                          <span>PENDING</span>
                          <span>GCASH</span>
                      </div>
                  </label>

                  <div class="actions listview__actions">
                      <div class="dropdown actions__item">
                          <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="">Update</a>
                            <a class="dropdown-item" href="">Cancel</a>
                          </div>
                      </div>
                  </div>
              </div>

          </div>

          <a href="todos.html" class="view-more">View More</a>
      </div>
      </div>
  </div>

  <footer class="footer hidden-xs-down">
      <p>© LoadPortal by PollyStore.</p>
  </footer>
@stop

@section('script')
<!-- Vendors -->
<script src="{{ config('app.asset_url') }}vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="{{ config('app.asset_url') }}vendors/bower_components/popper.js/dist/umd/popper.min.js"></script>
<script src="{{ config('app.asset_url') }}vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{ config('app.asset_url') }}vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="{{ config('app.asset_url') }}vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>
<script src="{{ config('app.asset_url') }}vendors/bower_components/salvattore/dist/salvattore.min.js"></script>
<script src="{{ config('app.asset_url') }}vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ config('app.asset_url') }}vendors/bower_components/flot/jquery.flot.js"></script>
<script src="{{ config('app.asset_url') }}vendors/bower_components/flot/jquery.flot.resize.js"></script>
<script src="{{ config('app.asset_url') }}vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
<script src="{{ config('app.asset_url') }}vendors/bower_components/peity/jquery.peity.min.js"></script>
<script src="{{ config('app.asset_url') }}vendors/bower_components/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- Charts and maps-->

<script src="{{ config('app.asset_url') }}demo/js/flot-charts/curved-line.js"></script>
<script src="{{ config('app.asset_url') }}demo/js/flot-charts/line.js"></script>
<script src="{{ config('app.asset_url') }}demo/js/flot-charts/chart-tooltips.js"></script>
<script src="{{ config('app.asset_url') }}demo/js/other-charts.js"></script>
<script>
var account = null, type = null;
$('#sendType').on('change', function() {
  var data = this.value.split(":");
  if(data.length < 1) {
    $("#sendAccount").val("");
    return false;
  }
  $("#sendAccount").val(data[1]);
  type =  data[0];
  account = data[1];
})

// Success Message
$('#sa-success').click(function(){
   swal({
       title: 'Good job!',
       text: 'We have sent the intructions to your mobile and email.',
       type: 'success',
       buttonsStyling: false,
       confirmButtonClass: 'btn btn-success',
       background: 'rgba(0, 0, 0, 0.96)'
   })
});
</script>
@stop
