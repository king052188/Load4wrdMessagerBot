
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
        <link rel="stylesheet" href="{{ $asset_url }}vendors/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="{{ $asset_url }}vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        @yield('css')

        <!-- App styles -->
        <link rel="stylesheet" href="{{ $asset_url }}css/app.min.css">
        <style>
            .header, .sidebar, .card, .quick-stats__item, .stats__item {
                background-color: rgba(0, 0, 0, 0.650);
                /* background-color: rgba(145, 0, 84, 0.5); */
            }
        </style>
    </head>

    <body data-sa-theme="1">
        <main class="main">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

            <header class="header">
                <div class="navigation-trigger hidden-xl-up" data-sa-action="aside-open" data-sa-target=".sidebar">
                    <i class="zmdi zmdi-menu"></i>
                </div>

                <div class="logo hidden-sm-down">
                    <h1><a href="/portal/dashboard">Load Portal v1</a></h1>
                </div>

                <ul class="top-nav">
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown" class="top-nav__notify"><i class="zmdi zmdi-email"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                            <div class="dropdown-header">
                                Messages

                                <div class="actions">
                                    <a href="messages.html" class="actions__item zmdi zmdi-plus"></a>
                                </div>
                            </div>

                            <div class="listview listview--hover">
                                <a href="" class="listview__item">
                                    <img src="{{ $asset_url }}demo/img/profile-pics/1.jpg" class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">
                                            David Belle <small>12:01 PM</small>
                                        </div>
                                        <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
                                    </div>
                                </a>

                                <a href="" class="listview__item">
                                    <img src="{{ $asset_url }}demo/img/profile-pics/2.jpg" class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">
                                            Jonathan Morris
                                            <small>02:45 PM</small>
                                        </div>
                                        <p>Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</p>
                                    </div>
                                </a>

                                <a href="" class="listview__item">
                                    <img src="{{ $asset_url }}demo/img/profile-pics/3.jpg" class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">
                                            Fredric Mitchell Jr.
                                            <small>08:21 PM</small>
                                        </div>
                                        <p>Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</p>
                                    </div>
                                </a>

                                <a href="" class="listview__item">
                                    <img src="{{ $asset_url }}demo/img/profile-pics/4.jpg" class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">
                                            Glenn Jecobs
                                            <small>08:43 PM</small>
                                        </div>
                                        <p>Ut vitae lacus sem ellentesque maximus, nunc sit amet varius dignissim, dui est consectetur neque</p>
                                    </div>
                                </a>

                                <a href="" class="listview__item">
                                    <img src="{{ $asset_url }}demo/img/profile-pics/5.jpg" class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">
                                            Bill Phillips
                                            <small>11:32 PM</small>
                                        </div>
                                        <p>Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet vel ante placerat</p>
                                    </div>
                                </a>

                                <a href="" class="view-more">View all messages</a>
                            </div>
                        </div>
                    </li>

                    <li class="dropdown top-nav__notifications">
                        <a href="" data-toggle="dropdown" class="top-nav__notify">
                            <i class="zmdi zmdi-notifications"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                            <div class="dropdown-header">
                                Notifications

                                <div class="actions">
                                    <a href="" class="actions__item zmdi zmdi-check-all" data-sa-action="notifications-clear"></a>
                                </div>
                            </div>

                            <div class="listview listview--hover">
                                <div class="listview__scroll scrollbar-inner">
                                    <a href="" class="listview__item">
                                        <img src="{{ $asset_url }}demo/img/profile-pics/1.jpg" class="listview__img" alt="">

                                        <div class="listview__content">
                                            <div class="listview__heading">David Belle</div>
                                            <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
                                        </div>
                                    </a>

                                    <a href="" class="listview__item">
                                        <img src="{{ $asset_url }}demo/img/profile-pics/2.jpg" class="listview__img" alt="">

                                        <div class="listview__content">
                                            <div class="listview__heading">Jonathan Morris</div>
                                            <p>Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</p>
                                        </div>
                                    </a>

                                    <a href="" class="listview__item">
                                        <img src="{{ $asset_url }}demo/img/profile-pics/3.jpg" class="listview__img" alt="">

                                        <div class="listview__content">
                                            <div class="listview__heading">Fredric Mitchell Jr.</div>
                                            <p>Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</p>
                                        </div>
                                    </a>

                                    <a href="" class="listview__item">
                                        <img src="{{ $asset_url }}demo/img/profile-pics/4.jpg" class="listview__img" alt="">

                                        <div class="listview__content">
                                            <div class="listview__heading">Glenn Jecobs</div>
                                            <p>Ut vitae lacus sem ellentesque maximus, nunc sit amet varius dignissim, dui est consectetur neque</p>
                                        </div>
                                    </a>

                                    <a href="" class="listview__item">
                                        <img src="{{ $asset_url }}demo/img/profile-pics/5.jpg" class="listview__img" alt="">

                                        <div class="listview__content">
                                            <div class="listview__heading">Bill Phillips</div>
                                            <p>Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet vel ante placerat</p>
                                        </div>
                                    </a>

                                    <a href="" class="listview__item">
                                        <img src="{{ $asset_url }}demo/img/profile-pics/1.jpg" class="listview__img" alt="">

                                        <div class="listview__content">
                                            <div class="listview__heading">David Belle</div>
                                            <p>Cum sociis natoque penatibus et magnis dis parturient montes</p>
                                        </div>
                                    </a>

                                    <a href="" class="listview__item">
                                        <img src="{{ $asset_url }}demo/img/profile-pics/2.jpg" class="listview__img" alt="">

                                        <div class="listview__content">
                                            <div class="listview__heading">Jonathan Morris</div>
                                            <p>Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</p>
                                        </div>
                                    </a>

                                    <a href="" class="listview__item">
                                        <img src="{{ $asset_url }}demo/img/profile-pics/3.jpg" class="listview__img" alt="">

                                        <div class="listview__content">
                                            <div class="listview__heading">Fredric Mitchell Jr.</div>
                                            <p>Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</p>
                                        </div>
                                    </a>
                                </div>

                                <div class="p-1"></div>
                            </div>
                        </div>
                    </li>

                    </li>

                    <li class="dropdown hidden-xs-down">
                        <a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                        <div class="dropdown-menu dropdown-menu-right">
                          <a href="" class="dropdown-item" href="">View Profile</a>
                          <a href="" class="dropdown-item" href="">Settings</a>
                          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                              Logout
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                        </div>
                    </li>

                    <li class="hidden-xs-down">
                        <a href="" class="top-nav__themes" data-sa-action="aside-open" data-sa-target=".themes"><i class="zmdi zmdi-palette"></i></a>
                    </li>
                </ul>

                <div class="clock hidden-md-down">
                    <div class="time">
                        <span class="time__hours"></span>
                        <span class="time__min"></span>
                        <span class="time__sec"></span>
                    </div>
                </div>
            </header>

            <aside class="sidebar">
                <div class="scrollbar-inner">

                    <div class="user">
                        <div class="user__info" data-toggle="dropdown">
                            <img class="user__img" src="{{ $asset_url }}demo/img/profile-pics/8.jpg" alt="">
                            <div>
                                <div class="user__name">Juan Dela Cruz</div>
                                <div class="user__email">juan.dela.cruz@gmail.com</div>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                          <a href="" class="dropdown-item" href="">View Profile</a>
                          <a href="" class="dropdown-item" href="">Settings</a>
                          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                              Logout
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                        </div>
                    </div>

                    <ul class="navigation">
                        <li class="navigation__active"><a href="/portal/dashboard"><i class="zmdi zmdi-home"></i> Home</a></li>

                        <li class="navigation__sub @@variantsactive">
                            <a href=""><i class="zmdi zmdi-view-week"></i> Wallet</a>

                            <ul>
                                <li class="@@sidebaractive"><a href="/portal/wallet/buy">Buy</a></li>
                                <li class="@@boxedactive"><a href="/portal/wallet/sell">Sell</a></li>
                                <li class="@@hiddensidebarboxedactive"><a href="/portal/wallet/transactions">Transactions</a></li>
                            </ul>
                        </li>

                        <li class="navigation__sub @@variantsactive">
                            <a href=""><i class="zmdi zmdi-view-week"></i> E-Load</a>

                            <ul>
                                <li class="@@sidebaractive"><a href="hidden-sidebar.html">Sell</a></li>
                                <li class="@@boxedactive"><a href="boxed-layout.html">Reloaded</a></li>
                                <li class="@@hiddensidebarboxedactive"><a href="hidden-sidebar-boxed-layout.html">Transactions</a></li>
                            </ul>
                        </li>


                    </ul>
                </div>
            </aside>

            <div class="themes">
              <div class="scrollbar-inner">
                  <a href="" class="themes__item active" data-sa-value="1"><img src="{{ $asset_url }}img/bg/1.jpg" alt=""></a>
                  <a href="" class="themes__item" data-sa-value="2"><img src="{{ $asset_url }}img/bg/2.jpg" alt=""></a>
                  <a href="" class="themes__item" data-sa-value="3"><img src="{{ $asset_url }}img/bg/3.jpg" alt=""></a>
                  <a href="" class="themes__item" data-sa-value="4"><img src="{{ $asset_url }}img/bg/4.jpg" alt=""></a>
                  <a href="" class="themes__item" data-sa-value="5"><img src="{{ $asset_url }}img/bg/5.jpg" alt=""></a>
                  <a href="" class="themes__item" data-sa-value="6"><img src="{{ $asset_url }}img/bg/6.jpg" alt=""></a>
                  <a href="" class="themes__item" data-sa-value="7"><img src="{{ $asset_url }}img/bg/7.jpg" alt=""></a>
                  <a href="" class="themes__item" data-sa-value="8"><img src="{{ $asset_url }}img/bg/8.jpg" alt=""></a>
                  <a href="" class="themes__item" data-sa-value="9"><img src="{{ $asset_url }}img/bg/9.jpg" alt=""></a>
                  <a href="" class="themes__item" data-sa-value="10"><img src="{{ $asset_url }}img/bg/10.jpg" alt=""></a>
              </div>
            </div>

            <section class="content">
            @yield('content')
            </section>
        </main>

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

        @yield('script')
        <script src="{{ $asset_url }}js/app.min.js"></script>
    </body>
</html>
