<nav class="main-header navbar navbar-expand navbar-shadow">
    <!-- Left navbar links -->
    <ul class="navbar-nav burger">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-flex">
            <div class="pp-logo">
                <img src="{{ asset('img/' . $user->profile_picture_path) }}" alt="Logo">
            </div>
            <div class="pp-name">{{ $user->name }}</div>
        </li>
    </ul>
</nav>