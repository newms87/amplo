<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title')</title>

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{url('css/my-account.css')}}"/>
</head>

<body>
<div id="page-container" class="container-fluid page-report @yield('page-class')">
    <div class="page-wrap">
        <nav id="primary-nav" class="row text-left nav-slide-inline slide-right">
            <div class="nav-group nav-group-appthis">
                <h3 class="nav-title">
                    <i class="fa fa-user"></i>
                    <span class="text">User</span>
                </h3>

                <ul>
                    <li class="link-stats">
                        <a href="{{url('test/my-account')}}">
                            <i class="fa fa-chart"></i>
                            <span class="text">My Account</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="page-content nav-content">
            <section id="page-header" class="page-header row">
                <div class="wrap">
                    <div class="col xs-3 header-home text-left">
                        <a class="inline-block btn-home header-btn" href="{{url('test/my-account')}}">
                            <i class="fa fa-home"></i>
                        </a>
                    </div>
                    <div class="col xs-6 header-title">
                        <div class="col-align ws-hack"></div>
                        <div class="col auto">
                            <h1>@yield('header-title')</h1>
                        </div>
                    </div>
                    <div class="col xs-3 header-nav text-right">
                        <a class="navbar-toggle header-btn" href="#primary-nav">
                            <div class="nav-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                    </div>
                </div>
            </section>

            <section id="page-sub-header" class="row page-sub-header">
                @yield('page-sub-header')
            </section>

            <section class="page-body row">
                <div class="wrap">
                    @yield('page-body')
                </div>
            </section>

            <section class="page-footer row">
                <div class="wrap">
                    <div class="copyright">&copy; {{date('Y')}} - Newman, LLC</div>
                </div>
            </section>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://unpkg.com/vue/dist/vue.js"></script>
<script type="text/javascript" src="{{url('js/test.js')}}"></script>

@yield('scripts')

<script src="https://use.fontawesome.com/c19cbbd23b.js"></script>
</body>
</html>
