<?php
/*
Dashboard:
    -our application consists of three parts :web, dashboard, api
    -we will make dashboard

    -dashboard is for admins , superadmins

    web.php:
        use App\Http\Controllers\Admin\HomeController as AdminHomeController;
        
        Route::prefix("/dashboard")->middleware(['auth', 'verified', 'can-enter-dashboard'])->group(function(){
            Route::get("/", [AdminHomeController::class, 'index']);
        });

        -we made group route for dashboard
        -since there are multiple HomeControllers , laravel made an alias name for homeController in admin and named it with AdminHomeController

        -we want user to log in , verified, admin or superadmin
    Middlewares:
        CanEnterDashboard.php:
            public function handle(Request $request, Closure $next)
            {
                $roleName = Auth::user()->role->name;
                if($roleName == "admin" || $roleName == "superadmin" ){
                    return $next($request);
                }
                return redirect(url('/'));
            }

        IsAdmin.php:
            public function handle(Request $request, Closure $next)
            {
                if(Auth::user()->role->name !== "admin" ){
                    return redirect(url('/'));
                }
                return $next($request);
            }
        IsStudent.php:
            public function handle(Request $request, Closure $next)
            {
                if(Auth::user()->role->name !== "student" ){
                    return redirect(url('/'));
                }
                return $next($request);
            }
            
        IsSuperAdmin.php:
            public function handle(Request $request, Closure $next)
            {
                if(Auth::user()->role->name !== "superadmin" ){
                    return redirect(url('/'));
                }
                return $next($request);
            }

    kernel.php:
        protected $routeMiddleware = [
            'auth' => \App\Http\Middleware\Authenticate::class,
            'admin' => \App\Http\Middleware\IsAdmin::class,
            'superadmin' => \App\Http\Middleware\IsSuperAdmin::class,
            'student' => \App\Http\Middleware\IsStudent::class,
            'can-enter-exam' => \App\Http\Middleware\CanEnterExam::class,
            'can-enter-dashboard' => \App\Http\Middleware\CanEnterDashboard::class,
        ]
    
    Admin/HomeController.php:
        public function index(){
            return view("admin.home.index");
        }
    
    views:
        -we copy dashboard/adminlte-basic/index.html and put the navbar, sidebar , footer, styles links, script links in admin/layout.blade.php
        -we put js and css files in public/admin folder and then used asset function to link on them

        -we put main content in admin/home/index.blade.php
        admin/layout.blade.php:
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="x-ua-compatible" content="ie=edge">

                <title>SkillsHub|Dashboard</title>

                <!-- Font Awesome Icons -->
                <link rel="stylesheet" href="{{ asset('admin/css/fontawesome.all.css') }}">
                <!-- Theme style -->
                <link rel="stylesheet" href="{{ asset('admin/css/adminlte.css') }}">
                <!-- Google Font: Source Sans Pro -->
                <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

                @yield("styles")
            </head>

            <body class="hold-transition sidebar-mini">
                <div class="wrapper">
                    <!-- Navbar -->
                    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                        <!-- Left navbar links -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                        class="fas fa-bars"></i></a>
                            </li>
                        </ul>

                    </nav>
                    <!-- /.navbar -->

                    <!-- Main Sidebar Container -->
                    <aside class="main-sidebar sidebar-dark-primary elevation-4">
                        <!-- Brand Logo -->
                        <a href="#" class="brand-link">
                            <img src="{{ asset('admin/img/logo.png') }}" alt="AdminLTE Logo"
                                class="brand-image img-circle elevation-3" style="opacity: .8">
                            <span class="brand-text font-weight-light">Skillshub</span>
                        </a>

                        <!-- Sidebar -->
                        <div class="sidebar">
                            <!-- Sidebar user panel (optional) -->
                            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                <div class="image">
                                    <img src="{{ asset('admin/img/user-profile.jpg') }}" class="img-circle elevation-2"
                                        alt="User Image">
                                </div>
                                <div class="info">
                                    <a href="#" class="d-block">Admin user</a>
                                </div>
                            </div>

                            <!-- Sidebar Menu -->
                            <nav class="mt-2">
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                    data-accordion="false">
                                    <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                                    <li class="nav-item has-treeview menu-open">
                                        <a href="#" class="nav-link active">
                                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                            <p>
                                                Sample Pages
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link active">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Page one</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Page two</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-th"></i>
                                            <p>
                                                Page three
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- /.sidebar-menu -->
                        </div>
                        <!-- /.sidebar -->
                    </aside>

                    @yield('main')

                    <!-- Control Sidebar -->
                    <aside class="control-sidebar control-sidebar-dark">
                        <!-- Control sidebar content goes here -->
                        <div class="p-3">
                        <h5>Title</h5>
                        <p>Sidebar content</p>
                        </div>
                    </aside>
                    <!-- /.control-sidebar -->

                    <!-- Main Footer -->
                    <footer class="main-footer">
                        <!-- To the right -->
                        <div class="float-right d-none d-sm-inline">
                        Anything you want
                        </div>
                        <!-- Default to the left -->
                        <strong>Copyright &copy; 2022 <a href="{{url("/")}}">Skillshub</a>.</strong> All rights reserved.
                    </footer>
                </div>
                <!-- ./wrapper -->

                <!-- REQUIRED SCRIPTS -->

                <!-- jQuery -->
                <script src="{{asset('admin/js/jquery.js')}}"></script>
                <!-- Bootstrap 4 -->
                <script src="{{asset('admin/js/bootstrap.bundle.js')}}"></script>
                <!-- AdminLTE App -->
                <script src="{{asset('admin/js/adminlte.js')}}"></script>

                @yield("scripts")
            </body>
            </html>

        
        admin/home/index.blade.php:
            @extends('admin.layout')

            @section('main')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Starter Page</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                    <div class="container-fluid">
                        <div class="row">

                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            @endsection


        web/layout.blade.php:
            @auth
                @if(Auth::user()->role->name == "student")
                    <li><a href="{{url('/profile')}}">{{__("web.profile")}}</a></li>
                @else
                    <li><a href="{{url('/dashboard')}}">{{__("web.dashboard")}}</a></li>
                @endif
                <li><a id="logout-link"  href="#">{{__("web.signout")}}</a></li>
            @endauth

            -we want to display dashboard link for admins or superadmins
            -while display profile link for students



        

*/