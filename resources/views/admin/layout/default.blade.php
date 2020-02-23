<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{config("app.site_name")}}">
    <meta name="author" content="{{config("app.site_name")}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset("admin")}}/images/favicon.ico">

    <title>@yield('title_area')</title>

    <!-- Base Css Files -->
    <link href="{{asset("admin")}}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{asset("admin")}}/css/bootstrap-select.min.css" rel="stylesheet" />

    <!-- Font Icons -->
    <link href="{{asset("admin")}}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="{{asset("admin")}}/vendors/ionicon/css/ionicons.min.css" rel="stylesheet" />
    <link href="{{asset("admin")}}/css/material-design-iconic-font.min.css" rel="stylesheet">

    <!-- animate css -->
    <link href="{{asset("admin")}}/css/animate.css" rel="stylesheet" />

    <!-- Waves-effect -->
    <link href="{{asset("admin")}}/css/waves-effect.css" rel="stylesheet">
    <!-- Plugins css-->
    <link href="{{asset("admin")}}/vendors/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="{{asset("admin")}}/vendors/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
    <link href="{{asset("admin")}}/vendors/notifications/notification.css" rel="stylesheet" />
    <!-- sweet alerts -->
    <link href="{{asset("admin")}}/vendors/sweet-alert/sweet-alert.min.css" rel="stylesheet">
    <!--calendar css-->
    <link href="{{asset("admin")}}/vendors/jquery-multi-select/multi-select.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("admin")}}/vendors/dropify-master/dist/css/dropify.min.css">

    <!-- Custom Files -->
    <link href="{{asset("admin")}}/css/helper.css" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin")}}/css/style.css" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin")}}/css/custom.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    <script src="{{asset("admin")}}/js/modernizr.min.js"></script>
    <!-- jQuery  -->
    <script src="{{asset("admin")}}/js/jquery.min.js"></script>
    <script src="{{asset("admin")}}/js/bootstrap.min.js"></script>

</head>

<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        @include('admin.layout.header')
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->

        @include('admin.layout.sidebar')
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
           @yield('main_section')
            <!-- content -->

            @include('admin.layout.footer')

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
    <script>
        var resizefunc = [];
    </script>
    <!-- jQuery  -->
    <script src="{{asset("admin")}}/js/waves.js"></script>
    <script src="{{asset("admin")}}/js/wow.min.js"></script>
    <script src="{{asset("admin")}}/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="{{asset("admin")}}/js/jquery.scrollTo.min.js"></script>
    <script src="{{asset("admin")}}/vendors/jquery-detectmobile/detect.js"></script>
    <script src="{{asset("admin")}}/vendors/fastclick/fastclick.js"></script>
    <script src="{{asset("admin")}}/vendors/jquery-slimscroll/jquery.slimscroll.js"></script>


    <!-- Counter-up -->
    <script src="{{asset("admin")}}/vendors/counterup/waypoints.min.js" type="text/javascript"></script>
    <script src="{{asset("admin")}}/vendors/counterup/jquery.counterup.min.js" type="text/javascript"></script>

    <!-- CUSTOM JS -->
    <script src="{{asset("admin")}}/js/jquery.app.js"></script>
    <script src="{{asset("admin")}}/js/bootstrap-select.min.js"></script>

    <script src="{{asset("admin")}}/vendors/dropify-master/dist/js/dropify.min.js"></script>
    <!-- Dashboard -->
    <!-- <script src="{{asset("admin")}}/jquery.dashboard.js"></script> -->

    <script type="text/javascript">
        /* ==============================================
            Counter Up
            =============================================== */
        jQuery(document).ready(function($) {
            $(".counter").counterUp({
                delay: 100,
                time: 1200
            });
            $(':file').dropify();
        });
    </script>

</body>

</html>
