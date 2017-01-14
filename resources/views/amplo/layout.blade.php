<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <title>@yield('page-title')</title>

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{url('css/amplo.css')}}"/>
    @yield('stylesheets')
    @yield('head')
</head>

<body>
<div id="page-container" class="container-fluid page-report @yield('page-class')">
    <div class="page-wrap">
        @include('amplo.navigation')

        <div class="page-content nav-content">
            <section id="page-header" class="page-header row">
                <div class="wrap">
                    <div class="col xs-3 header-home text-left">
                        <a class="inline-block btn-home header-btn" href="{{url('/')}}">
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.8/{{App::environment('production') ? 'vue.min.js' : 'vue.js'}}"></script>
<script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>
<!--<script type="text/javascript" src="{{url('js/amplo.js')}}"></script>-->

@yield('scripts')

<script src="https://use.fontawesome.com/c19cbbd23b.js"></script>
</body>
</html>
