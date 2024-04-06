<aside class="main-sidebar sidebar-light">
    <a href="{{ $user->role->name == 'dosen' ? '/dashboard/reports' : '/' }}" class="brand-link navbar-shadow">
        <div class="logo">
            <img src="/assets/img/logo.png" alt="Logo" class="brand-image">
        </div>
    </a>

    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-40">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if ($user->role->name != 'dosen') 
                <li class="nav-items">
                    <a href="/" class="nav-link">
                        <i class="fa-solid fa-home"></i>
                        Beranda
                    </a>
                </li>
                @endif

                @if ($user->role->name == 'mahasiswa') 
                    <li class="nav-items {{ Request::is('dashboard/student/competition*') ? 'active' : '' }}">
                        <a href="/dashboard/student/competition" class="nav-link">
                        <i class="fa-solid fa-file"></i>
                            Pendaftaran
                        </a>
                    </li>
                    <li class="nav-items {{ Request::is('dashboard/student/profile*') ? 'active' : '' }}">
                        <a href="/dashboard/student/profile" class="nav-link">
                        <i class="fa-solid fa-user"></i>
                            User
                        </a>
                    </li>
                @endif

                @if ($user->role->name != 'mahasiswa')
                    <li class="nav-items {{ Request::is('dashboard/reports*') ? 'active' : '' }}">
                        <a href="/dashboard/reports" class="nav-link">
                        <i class="fa-solid fa-chart-simple"></i>
                            Report
                        </a>
                    </li>
                @endif

                @if ($user->role->name == 'biro' || $user->role->name == 'dosen')
                    <li class="nav-items {{ Request::is('dashboard/validations*') ? 'active' : '' }}">
                        <a href="/dashboard/validations" class="nav-link">
                        <i class="fa-solid fa-magnifying-glass"></i>
                            Validation
                        </a>
                    </li>
                @endif

                @if ($user->role->name == 'biro')
                    <li class="nav-items {{ Request::is('dashboard/settings*') ? 'active' : '' }}">
                        <a href="/dashboard/settings" class="nav-link">
                        <i class="fa-solid fa-gear"></i>
                            Setting
                        </a>
                    </li>
                    <li class="nav-items {{ Request::is('dashboard/users*') ? 'active' : '' }}">
                        <a href="/dashboard/users" class="nav-link">
                        <i class="fa-solid fa-user"></i>
                            User
                        </a>
                    </li>
                @endif
                <li class="nav-items">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <button type="submit" class="nav-link logout">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        Keluar
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</aside>