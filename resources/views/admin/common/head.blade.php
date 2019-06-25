<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Purple Admin</title>
    <script src="/admins/js/jquery-3.4.1.min.js"></script>
    <script src="/admins/layer/layer.js"></script>
    <link rel="stylesheet" href="/admins/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/admins/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admins/css/style.css">
    <link rel="shortcut icon" href="/admins/images/favicon.png" />
    <script src="/admins/js/jquery-3.4.1.min.js"></script>
    <script src="/admins/layer/layer.js"></script>
    <script src="/admins/vendors/js/vendor.bundle.base.js"></script>
    <script src="/admins/vendors/js/vendor.bundle.addons.js"></script>
    <script src="/admins/js/off-canvas.js"></script>
    <script src="/admins/js/misc.js"></script>
    <script src="/admins/js/dashboard.js"></script>
    <style>
        a:not([href]):not([tabindex]) {
            color: #000000;
        }
    </style>
</head>
<body>
<div class="container-scroller">
<<<<<<< HEAD
    <!-- partial:partials/_navbar.html -->
=======
>>>>>>> origin/muyinya
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="index.html"><img src="/admins/images/logo.svg" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="/admins/images/logo-mini.svg" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-img">
                            <img src="/admins/images/faces/face1.jpg" alt="image">
                            <span class="availability-status online"></span>
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black">@if(empty(session('AdminUser'))) 后台管理员 @else {{session('AdminUser')->uname}} @endif</p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
{{--                        <a class="dropdown-item" href="/admin/login/center/{{session('AdminUser')->id}}/{{session('AdminUser')->_token}}">--}}
{{--                            <i class="mdi mdi-cached mr-2 text-success"></i>--}}
{{--                            个人中心--}}
{{--                        </a>--}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/admin/logout">
                            <i class="mdi mdi-logout mr-2 text-primary"></i>
                            退出
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <div class="container-fluid page-body-wrapper">