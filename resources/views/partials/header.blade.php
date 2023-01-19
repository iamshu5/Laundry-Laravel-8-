@php $user = Illuminate\Support\Facades\Auth::user(); @endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} • {{ Str::upper($user->posisi) }}</title>
    {{-- FAVICON --}}
    <link rel="icon" type="image/x-icon" href="{{ url('assets/admin/img/logo-laundry.png') }}">
    {{-- Kit FontAwesome --}}
    <link rel="stylesheet" href="{{ url('assets/admin/js/7fdd60d3a4.js') }}">
    <link href="{{ url('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- CSS Sb Admin-->
    <link href="{{ url('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body>

    <div id="wrapper">
        {{-- SIDEBAR  --}}
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url($user->posisi . '/dashboard') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ url('assets/admin/img/logo-laundry.png') }}" width="50" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">LaundryShu | {{ Str::upper($user->posisi) }}</div>
            </a>

            <hr class="sidebar-divider my-0">
            {{-- Nav Item - Dashboard --}}
            <li class="nav-item {{ $title === 'Dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url($user->posisi . '/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            @include('partials.sidebar.' . $user->posisi)

            {{-- TOMBOL SIDEBAR --}}
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul><!-- End Tombol Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    {{-- TOMBOL SIDEBAR MOBILE --}}
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <span class="ml-md-3 font-italic" id="clock-realtime"><?= date('Y-m-d H:i:s') ?> </span>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        {{-- DROPDOWN LOGOUT --}}
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!--
                            Logout Modal berada di resources => views => layouts =>admin-layouts => footer.blade.php
                        -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-800 small"><i
                                        class="fa-solid fa-user-shield"></i> Hi, {{ auth()->user()->nama_user }}</span>
                                        {{-- {{ auth()->user()->nama_user }} --}}
                                <img class="img-profile rounded-circle"
                                    src="{{ url('assets/admin/img/logo-laundry.png') }}" alt="Foto Profile Admin">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
