<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | General UI</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/static/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- summernote -->
<!--    <link rel="stylesheet" href="/static/adminlte/plugins/summernote/summernote-bs4.min.css">-->
    <!-- Select2 -->
    <link rel="stylesheet" href="/static/adminlte/plugins/select2/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/static/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="/static/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/static/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="<?php echo url('admin_recipes'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-concierge-bell"></i>
                            <p>Рецепты</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo url('admin_users'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Пользователи</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo url('admin_categories'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>Категории</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo url('admin_ingredients'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-cheese"></i>
                            <p>Ингредиенты</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
