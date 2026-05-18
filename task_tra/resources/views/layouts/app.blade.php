<!DOCTYPE html>
<html lang="{{ app()->getLocale() == 'ar' ? 'ar' : 'en' }}"
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Blog Platform')
    </title>

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Font Awesome -->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Font -->

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap"
          rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Tajawal',sans-serif;
            background:linear-gradient(
                135deg,
                #667eea 0%,
                #764ba2 100%
            );
            min-height:100vh;
        }

        .custom-navbar{
            background:rgba(0,0,0,0.95);
            padding:15px 0;
            overflow-x:auto;
            white-space:nowrap;
        }

        .navbar-brand-custom{
            color:white !important;
            font-size:24px;
            font-weight:bold;
            text-decoration:none;
        }

        .nav-link-custom{
            color:rgba(255,255,255,0.8) !important;
            text-decoration:none;
            margin:0 8px;
            font-size:16px;
            transition:.3s;
            white-space:nowrap;
        }

        .nav-link-custom:hover{
            color:white !important;
        }

        .btn-login{
            background:linear-gradient(
                135deg,
                #28a745 0%,
                #20c997 100%
            );
            color:white;
            border:none;
            padding:8px 20px;
            border-radius:50px;
            text-decoration:none;
            white-space:nowrap;
        }

        .btn-logout{
            background:linear-gradient(
                135deg,
                #dc3545 0%,
                #c82333 100%
            );
            color:white;
            border:none;
            padding:8px 20px;
            border-radius:50px;
            white-space:nowrap;
        }

        .main-container{
            padding:40px 0;
        }

        .card{
            background:white;
            padding:20px;
            border-radius:12px;
        }

        @media(max-width:768px){

            .navbar-brand-custom{
                font-size:18px;
            }

            .nav-link-custom{
                font-size:14px;
            }

            .btn-login,
            .btn-logout{
                padding:6px 15px;
                font-size:14px;
            }

        }

    </style>

</head>

<body>

<nav class="custom-navbar">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center">

            <!-- Logo -->

            <a href="{{ url('/') }}"
               class="navbar-brand-custom">

                <i class="fas fa-blog me-2"></i>

                Blog Platform

            </a>

            <!-- Links -->

            <div class="d-flex align-items-center gap-2">

                <a href="{{ url('/') }}"
                   class="nav-link-custom">

                    <i class="fas fa-home me-1"></i>

                    الرئيسية

                </a>

                @auth('admin')

                    <a href="{{ route('blogs.index') }}"
                       class="nav-link-custom">

                        <i class="fas fa-newspaper me-1"></i>

                        Blogs

                    </a>

                    <a href="{{ route('admins.index') }}"
                       class="nav-link-custom">

                        <i class="fas fa-user-shield me-1"></i>

                        Add Admin

                    </a>

                    <a href="{{ route('users.index') }}"
                       class="nav-link-custom">

                        <i class="fas fa-user me-1"></i>

                        Add User

                    </a>

                    <a href="{{ route('trash') }}"
                       class="nav-link-custom">

                        <i class="fas fa-trash me-1"></i>

                        Trash

                    </a>

                @endauth

                <div class="ms-2">

                    @auth('admin')

                        <form action="{{ route('admin.logout') }}"
                              method="POST"
                              style="display:inline;">

                            @csrf

                            <button type="submit"
                                    class="btn-logout">

                                <i class="fas fa-sign-out-alt me-1"></i>

                                Logout

                            </button>

                        </form>

                    @else

                        <a href="{{ route('admin.login') }}"
                           class="btn-login">

                            <i class="fas fa-lock me-1"></i>

                            Admin Login

                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </div>

</nav>

<main class="main-container">

    <div class="container">

        @yield('content')

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>