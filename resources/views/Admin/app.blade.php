<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('Admin/img/writer.png')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('Admin/assets/images/icon/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('Admin/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/assets/css/slicknav.min.css')}}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- others css -->
    <link rel="stylesheet" href="{{asset('Admin/assets/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/assets/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('Admin/assets/css/responsive.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- modernizr css -->
    <script src="{{asset('Admin/assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-hsMvGmzQ8FjRHD10fl5Vf5SHhp/G/gU8hqCpHZ+8hb8lT6Cdf3N2x5uiJN3eCrL4" crossorigin="anonymous">

</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<!-- preloader area start -->
<div id="preloader">
    <div class="loader"></div>
</div>
<!-- preloader area end -->
<!-- page container area start -->
<div class="page-container">
    <!-- sidebar menu area start -->
    <div class="sidebar-menu">
        <div class="sidebar-header">
            <div class="logo">
                <h style="color: #1cbb8c;">Welcome {{auth()->user()->name}}</h>
            </div>
        </div>
        @include('Admin.sidebar')
    </div>
    <!-- sidebar menu area end -->
    <!-- main content area start -->
    <div class="main-content">
        <!-- header area start -->
        <div class="header-area">
            <div class="row align-items-center">
                <!-- nav and search button -->
                <div class="col-md-6 col-sm-8 clearfix">
                    <div class="nav-btn pull-left">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="search-box pull-left">
                        <form action="#">
                            <input type="text" name="search" placeholder="Search..." required>
                            <i class="ti-search"></i>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- header area end -->
        <!-- page title area start -->
        <div class="page-title-area mt-4">
            <div class="row align-items-center">
            </div>
        </div>
        <!-- main content area end -->
        @include('sweetalert::alert')


        @yield('content')
        <!-- footer area start-->

        <!-- offset area end -->
        <!-- jquery latest version -->
        <script src="{{asset('Admin/assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
        <!-- bootstrap 4 js -->
        <script src="{{asset('Admin/assets/js/popper.min.js')}}"></script>
        <script src="{{asset('Admin/assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('Admin/assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('Admin/assets/js/metisMenu.min.js')}}"></script>
        <script src="{{asset('Admin/assets/js/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('Admin/assets/js/jquery.slicknav.min.js')}}"></script>

        <!-- start chart js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
        <!-- start highcharts js -->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <!-- start zingchart js -->
        <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
        <script>
            zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
            ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
        </script>
        <!-- all line chart activation -->
        <script src="{{asset('Admin/assets/js/line-chart.js')}}"></script>
        <!-- all pie chart -->
        <script src="{{asset('Admin/assets/js/pie-chart.js')}}"></script>
        <!-- others plugins -->
        <script src="{{asset('Admin/assets/js/plugins.js')}}"></script>
        <script src="{{asset('Admin/assets/js/scripts.js')}}"></script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyDSBhBdaZIQgMyFgqF4+flfcOqKazf38y" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

{!! Toastr::message() !!}
</body>

</html>
