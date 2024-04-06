@extends('layouts.main')

@section('container')
<div class="pagelayout-login">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session()->has('loginError'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Ops!',
            text: 'Email / Password yang anda masukan salah'
        })
    </script>
    @endif
    <nav class="navbar navbar-light bg-faded navbar-expand nav-setting">
        <div class="primary-navigation">
            <nav class="moremenu navigation observed">
                <ul role="menubar" class="nav more-nav navbar-nav">
                    <li class="nav-item" role="none">
                        <a role="menuitem" class="nav-link {{ Request::is('/') ? 'active' : '' }} " href="/">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item" role="none">
                        <a role="menuitem" class="nav-link {{ Request::is('/register*') ? 'active' : '' }} " href="/register">
                            Register
                        </a>
                    </li>
                    <li class="nav-item" role="none">
                        <a role="menuitem" class="nav-link" href="#" data-toggle="modal" data-target="#popupabout" data-bs-toggle="modal" data-bs-target="#popupabout">
                            Tentang Kami
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>
    <div class="login-wrapper">
        <div class="login-container">
            <div class="login-logo">
                <img id="logoimage" src="/assets/img/logo.png" class="img-fluid" alt="">
            </div>
            <form class="login-form" action="/login" method="post" id="login">
                @csrf
                <div class="login-form-username form-group">
                    <label for="username" class="sr-only">
                        <i class="fa-solid fa-user"></i><span>\</span>Username (email students)
                    </label>
                    <input type="text" name="campus_email" class="form-control form-control-lg" placeholder="Username (email students)" autocomplete="email">
                </div>
                <div class="login-form-password form-group input-password">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Password" autocomplete="current-password">
                    <i id="togglePassword" class="fa fa-eye"></i>
                </div>
                <div class="login-form-submit form-group">
                    <button class="btn btn-primary btn-lg" type="submit" id="loginbtn">LOGIN</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection