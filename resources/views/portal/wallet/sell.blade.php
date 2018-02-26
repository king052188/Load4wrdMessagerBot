@extends('themes.portal')
<?php
  $asset_url = "http://asset-librares.duckdns.org/";
?>
@section('content')
  <header class="content__title">
      <h2>Sell Wallet Load</h2>
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
                <h4 class="card-title">Sell Wallet Load</h4>
                <h6 class="card-subtitle">Basic Textual inputs with different sizes by height and column.</h6>

                <h3 class="card-body__title">Account# From</h3>
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Enter your mobile#" value="09171236547" disabled>
                    <i class="form-group__bar"></i>
                </div>

                <h3 class="card-body__title">Account# To</h3>
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Enter your mobile#">
                    <i class="form-group__bar"></i>
                </div>

                <br>
                <h3 class="card-body__title">Amount</h3>
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Enter amount I.e.: 1000">
                    <i class="form-group__bar"></i>
                </div>
                <button type="button" class="btn btn-danger btn-block">Reload</button>
            </div>
          </div>
      </div>

      <div class="card todo">
          <div class="card-body">
              <h4 class="card-title">Wallet Transactions</h4>
              <h6 class="card-subtitle">Your Latest 10 Wallet Transfered</h6>
          </div>
          <div class="listview">
              <div class="listview__item">
                  <label class="custom-control custom-control--char todo__item">
                      <input class="custom-control-input" type="checkbox" value="" checked>
                      <span class="custom-control--char__helper"><i>F</i></span>
                      <div class="todo__info">
                          <span>Fivamus sagittis lacus vel augue laoreet rutrum faucibus dolor</span>
                          <small>Today at 8.30 AM</small>
                      </div>

                      <div class="listview__attrs">
                          <span>#Messages</span>
                          <span>!!!</span>
                      </div>
                  </label>

                  <div class="actions listview__actions">
                      <div class="dropdown actions__item">
                          <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                          <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="">Mark as completed</a>
                              <a class="dropdown-item" href="">Delete</a>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="listview__item">
                  <label class="custom-control custom-control--char todo__item">
                      <input class="custom-control-input" type="checkbox" value="" checked>
                      <span class="custom-control--char__helper"><i>N</i></span>
                      <div class="todo__info">
                          <span>Nullam id dolor id nibh ultricies vehicula ut id elit</span>
                          <small>Today at 12.30 PM</small>
                      </div>

                      <div class="listview__attrs">
                          <span>#Clients</span>
                          <span>!!</span>
                      </div>
                  </label>

                  <div class="actions listview__actions">
                      <div class="dropdown actions__item">
                          <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                          <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="">Mark as completed</a>
                              <a class="dropdown-item" href="">Delete</a>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="listview__item">
                  <label class="custom-control custom-control--char todo__item">
                      <input class="custom-control-input" type="checkbox" value="">
                      <span class="custom-control--char__helper"><i>C</i></span>
                      <div class="todo__info">
                          <span>Cras mattis consectetur purus sit amet fermentum</span>
                          <small>Tomorrow at 10.30 AM</small>
                      </div>

                      <div class="listview__attrs">
                          <span>#Clients</span>
                          <span>!!</span>
                      </div>
                  </label>

                  <div class="actions listview__actions">
                      <div class="dropdown actions__item">
                          <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                          <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="">Mark as completed</a>
                              <a class="dropdown-item" href="">Delete</a>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="listview__item">
                  <label class="custom-control custom-control--char todo__item">
                      <input class="custom-control-input" type="checkbox" value="">
                      <span class="custom-control--char__helper"><i>I</i></span>
                      <div class="todo__info">
                          <span>Integer posuere erat a ante venenatis dapibus posuere velit aliquet</span>
                          <small>05/08/2017 at 08.00 AM</small>
                      </div>

                      <div class="listview__attrs">
                          <span>#Server</span>
                          <span>!</span>
                      </div>
                  </label>

                  <div class="actions listview__actions">
                      <div class="dropdown actions__item">
                          <i class="zmdi zmdi-more-vert" data-toggle="dropdown"></i>
                          <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="">Mark as completed</a>
                              <a class="dropdown-item" href="">Delete</a>
                          </div>
                      </div>
                  </div>
              </div>

          </div>

          <a href="todos.html" class="view-more">View More</a>
      </div>
  </div>

  <footer class="footer hidden-xs-down">
      <p>© LoadPortal by PollyStore.</p>
  </footer>
@stop

@section('script')
<!-- Vendors -->
<script src="{{ $asset_url }}vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="{{ $asset_url }}vendors/bower_components/popper.js/dist/umd/popper.min.js"></script>
<script src="{{ $asset_url }}vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{ $asset_url }}vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="{{ $asset_url }}vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>
<script src="{{ $asset_url }}vendors/bower_components/salvattore/dist/salvattore.min.js"></script>
<script src="{{ $asset_url }}vendors/bower_components/flot/jquery.flot.js"></script>
<script src="{{ $asset_url }}vendors/bower_components/flot/jquery.flot.resize.js"></script>
<script src="{{ $asset_url }}vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
<script src="{{ $asset_url }}vendors/bower_components/peity/jquery.peity.min.js"></script>
<!-- Charts and maps-->
<script src="{{ $asset_url }}demo/js/flot-charts/curved-line.js"></script>
<script src="{{ $asset_url }}demo/js/flot-charts/line.js"></script>
<script src="{{ $asset_url }}demo/js/flot-charts/chart-tooltips.js"></script>
<script src="{{ $asset_url }}demo/js/other-charts.js"></script>
@stop
