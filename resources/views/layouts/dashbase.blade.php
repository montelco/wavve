<!DOCTYPE html>
<html lang="en" manifest="cache.manifest">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#101010">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>{{ Auth::user()->name }}'s Dashboard | Wavvve</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::to('/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ URL::to('/css/font.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/css/nav.css') }}">
    <link href="{{ URL::to('/css/sb-admin.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ URL::to('/css/plugins/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ URL::to('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="{{ url('/') }}"><i class="fa fa-fw fa-home"></i> Wavvve</a>
                    </li>                    
                    <li id="usr_controls_boundary">
                        <a href="javascript:;" data-toggle="collapse" data-target="#integrated_usr_controls"> {{ Auth::user()->name }} <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="integrated_usr_controls" class="collapse">
                            <li>
                                <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-power-off"></i> Logout</a>
                            </li>
                            <li>
                                <a href="{{ url('/settings') }}"><i class="fa fa-btn fa-cog"></i> Settings</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('/dashboard') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard Home</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#pass_manager_well" aria-expanded="true"><i class="fa fa-fw fa-tags"></i> Manage Passes <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="pass_manager_well" class="collapse">
                            <li>
                                <a href="{{ url('/passes/editor') }}">Create Pass</a>
                            </li>
                            <li>
                                <a href="{{ url('/passes/manage') }}">View Passes</a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li>
                        <a href="{{ url('/passes/schedule') }}"><i class="fa fa-fw fa-calendar-o"></i> Pass Schedule</a>
                    </li> --}}
                    {{-- <li>
                        <a href="{{ url('/passes/map') }}"><i class="fa fa-fw fa-map-marker"></i> Manage Beacons</a>
                    </li> --}}
                    <li>
                        <a href="{{ url('/passes/analytics') }}"><i class="fa fa-fw fa-line-chart"></i> Pass Analytics</a>
                    </li>
                    <li>
                        <a href="{{ url('/settings') }}"><i class="fa fa-fw fa-wrench"></i> Settings</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                @yield('dashContent')
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>

    <!-- jQuery -->

    @yield('jQueryVersion')

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::to('/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("[href]").each(function() {
                if (this.href == window.location.href) {
                    $(this).addClass("active");
                }
            });
        });
    </script>
</body>
</html>
