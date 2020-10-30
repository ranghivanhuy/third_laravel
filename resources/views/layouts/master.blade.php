<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laravel | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
        href="{{asset('assets/admin/dist/css/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{asset('assets/admin/dist/css/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- bootstrap slider -->
    <link rel="stylesheet"
        href="{{asset('assets/admin/dist/css/plugins/seiyria-bootstrap-slider/css/bootstrap-slider.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/dist/css/skins/_all-skins.min.css')}}">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/style.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Administrator</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Username <b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Profie</a></li>
                                <li><a href="#">Logout</a></li>
                            </ul>
                        </li>
                    </ul>


            </nav>

        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{asset('assets/admin/image/avatar.png')}}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>Nguyễn Văn A</p>
                        <a href="#"><i class="fa fa-send-o"></i>Profile</a>
                    </div>
                </div>

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Products</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('products.index') }}"><i class="fa fa-check-square"></i> List
                                    products</a></li>
                            <li><a href="{{ route('products.create') }}"><i class="fa fa-plus-square"></i> Add
                                    product</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-files-o"></i>
                            <span>Categories</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('categories.index') }}"><i class="fa fa-check-square"></i>List
                                    categories</a></li>
                            <li><a href="{{ route('categories.create') }}"><i class="fa fa-plus-square"></i>Add
                                    category</a></li>
                        </ul>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('breadcumb')
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('main-content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.18
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- jQuery 3 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('assets/admin/dist/js/handleDeleteCate.js')}}"></script>
    <script src="{{asset('assets/admin/dist/js/handleImage.js')}}"></script>
    <script src="{{asset('assets/admin/dist/js/edit-product.js')}}"></script>
    <script src="{{asset('assets/admin/dist/js/handleDelProduct.js')}}"></script>
    <script src="{{asset('assets/admin/dist/js/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('assets/admin/dist/js/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/admin/dist/js/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/admin/dist/js/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/admin/dist/js/dist/js/demo.js')}}"></script>
    <!-- Bootstrap slider -->
    <script src="{{asset('assets/admin/dist/js/plugins/seiyria-bootstrap-slider/bootstrap-slider.min.js')}}"></script>
    <script>
    $(function() {
        /* BOOTSTRAP SLIDER */
        $('.slider').slider()
    })
    </script>
</body>

</html>