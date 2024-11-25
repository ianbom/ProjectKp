<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">

    @stack('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.css" rel="stylesheet">

    @stack('addon-style')
</head>

<body style="max-width: 100vw;">
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            <!-- Sidebar -->
            <div class="dashboard">
                <div class="dashboard-nav">
                    <header>
                        <a href="#!" class="menu-toggle">
                            <img src="/images/dashboard/close.svg" alt="" srcset="" class="menu-logo"></a>
                        <a href="#" class="brand-logo">
                            <img src="/images/dashboard/logo.png" alt="" srcset=""
                                class="logo-dashboard">
                            <span>
                                <p class="title-dashboard my-auto" style="color: white;">
                                    Karyawan Portal
                                </p>
                            </span>
                        </a>
                    </header>
                    <nav class="dashboard-nav-list">
                        <div>
                            <a href="{{ route('karyawan.task.index') }}"
                                class="dashboard-nav-item  {{ request()->is('karyawan') ? 'active-item' : '' }}">
                                <svg class="menu-icon menu-icon-normal" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M4 13h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zm0 8h6c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1zm10 0h6c.55 0 1-.45 1-1v-8c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zM13 4v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1z" />
                                </svg>
                                <p class="menu-font ml-1 my-auto  {{ request()->is('karyawan') ? 'active-menu' : '' }}">
                                    My Task
                                </p>
                            </a>
                        </div>

                        <div>
                            <a href="{{ route('karyawan.task.index') }}"
                                class="dashboard-nav-item  {{ request()->is('karyawan') ? 'active-item' : '' }}">
                                <svg class="menu-icon menu-icon-normal" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M4 13h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zm0 8h6c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1zm10 0h6c.55 0 1-.45 1-1v-8c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zM13 4v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1z" />
                                </svg>
                                <p class="menu-font ml-1 my-auto  {{ request()->is('karyawan') ? 'active-menu' : '' }}">
                                    My Project
                                </p>
                            </a>
                        </div>




                        {{-- <div class="nav-item-divider" style="margin-top: 40vh;"></div> --}}
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                            class="dashboard-nav-item" style="margin-top: 25vh;">
                            <svg class="menu-icon menu-icon-normal" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10ZM7 11V8l-5 4l5 4v-3h8v-2H7Z" />
                            </svg>
                            <p class="menu-font ml-1 my-auto">
                                Log Out
                            </p>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </nav>
                </div>
                <div class="dashboard-app">
                    <header class="dashboard-toolbar justify-content-between">
                        <a href="#!" class="menu-toggle">
                            <img src="/images/dashboard/menu.svg" alt="" srcset="" class="menu-logo">
                        </a>

                        <div class="mr-3">
                            <ul class="navbar-nav ml-auto d-none d-lg-flex">
                                <li class="nav-item dropdown">
                                    <a class="nav-link d-flex" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ Storage::url(Auth::user()->photo) }}" alt=""
                                            class="rounded-circle mr-2 profile-picture" />
                                        <div class="d-block my-auto">
                                            <p class="name-user my-auto">
                                                Hi, {{ Auth::user()->name }}
                                            </p>
                                            <p class="status-user my-auto">Administrator</p>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        {{-- <a class="dropdown-item" href="/dashboard-account.html">Settings</a> --}}
                                        {{-- <div class="dropdown-divider"></div> --}}
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">

                                            Logout
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </header>

                </div>
            </div>
            <!-- /#sidebar-wrapper -->



            <!-- Page Content -->
            <div class="dashboard-content" data-aos="fade-up">
                <div class="dashboard-top mr-4 ml-4" style="margin-top: 20vh; margin-bottom: 10vh;">

                    <!-- Content -->
                    @yield('content')

                </div>


            </div>

            <!-- /#page-content-wrapper -->
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="/script/popper.js"></script>
    <script src="/script/main.js"></script>
    <script src="/script/dashboard.js"></script>

    <script>
        AOS.init();
    </script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    @stack('addon-script')
</body>

</html>
