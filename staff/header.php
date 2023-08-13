<?php include ('session.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>

        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="/egcs/admin/css/bootstrap.min.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="/egcs/admin/css/font-awesome.min.css">

        <!-- Ionicons -->
        <link rel="stylesheet" href="/egcs/admin/css/ionicons.min.css">

        <!-- Theme style -->
        <link rel="stylesheet" href="/egcs/admin/css/AdminLTE.min.css">

        <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/egcs/admin/css/_all-skins.min.css">

        <!-- Morris chart -->
        <link rel="stylesheet" href="/egcs/admin/css/morris.css">

        <!-- jvectormap -->
        <link rel="stylesheet" href="/egcs/admin/css/jquery-jvectormap.css">

        <!-- wysihtml -->
        <link rel="stylesheet" href="/egcs/admin/css/bootstrap3-wysihtml5.min.css">

        <!-- Date Picker -->
        <link rel="stylesheet" href="/egcs/admin/css/bootstrap-datepicker.min.css">

        <!-- Daterange picker -->
        <link rel="stylesheet" href="/egcs/admin/css/daterangepicker.css">
    </head>
    
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="#" class="logo">
                    <span class="logo-mini"><i class="ion ion-university"></i></span>
                    <span class="logo-lg"><i class="ion ion-university"></i>&nbsp;Clearance System</span>
                </a>
    
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user"></i>
                                    <span class="hidden-xs"><?php echo $username ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <i class="fa fa-user"></i>
                                        <p style="color: #000"><?php echo $username ?> - <?php echo $position ?></p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <?php include('sidebar.php') ?>