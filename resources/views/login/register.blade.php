@extends('layouts.main')

@section('container')
<div class="pagelayout-login">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
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
                        <a role="menuitem" class="nav-link" href="#" data-target="#popupabout" data-bs-toggle="modal" data-bs-target="#popupabout">
                            Tentang Kami
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>
    <div class="login-wrapper">
        <div class="login-container register-container">
            <div class="login-logo">
                <img id="logoimage" src="/assets/img/logo.png" class="img-fluid" alt="">
            </div>
            <form class="row g-3" action="/register" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 p-left">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" required>
                </div>
                <div class="col-md-6 p-right">
                    <input maxlength="8" type="text" name="nim" class="form-control  @error('nim') is-invalid @enderror" placeholder="NIM" required>
                </div>
                <div class="col-md-6 p-left">
                    <input type="email" id="campus_emailstudent" name="campus_email" class="form-control  @error('campus_email') is-invalid @enderror" placeholder="Email Students" required>
                    <div class="emailHelp" id="emailHelp"></div>
                </div>
                <div class="col-md-6 p-right register-password">
                    <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password" required>
                    <i id="togglePassword" class="fa fa-eye"></i>
                </div>
                <div class="col-md-6 p-left">
                    <input type="text" name="phone_number" class="form-control  @error('phone_number') is-invalid @enderror" placeholder="No Hp" required>
                </div>
                <div class="col-md-6 p-right">
                    <input type="email" name="personal_email" class="form-control  @error('personal_email') is-invalid @enderror" placeholder="Email Pribadi" required>
                </div>
                <div class="col-md-6 p-left">
                    <select class="form-select custom-select" name="faculty" id="faculty">
                        <option value="Teologi" {{ old('faculty') == "Teologi" ? 'selected' : '' }}>Teologi</option>
                        <option value="Arsitektur" {{ old('faculty') == "Arsitektur" ? 'selected' : '' }}>Arsitektur</option>
                        <option value="Bioteknologi" {{ old('faculty') == "Bioteknologi" ? 'selected' : '' }}>Bioteknologi</option>
                        <option value="Bisnis" {{ old('faculty') == "Bisnis" ? 'selected' : '' }}>Bisnis</option>
                        <option value="Teknologi Informasi" {{ old('faculty') == "Teknologi Informasi" ? 'selected' : '' }}>Teknologi Informasi</option>
                        <option value="Kedokteran" {{ old('faculty') == "Kedokteran" ? 'selected' : '' }}>Kedokteran</option>
                        <option value="Kependidikan dan Humaniora" {{ old('faculty') == "Kependidikan dan Humaniora" ? 'selected' : '' }}>Kependidikan dan Humaniora</option>
                    </select>
                </div>
                <div class="col-md-6 p-right">
                    <select class="form-select custom-select" name="study_program" id="study_program">
                        <option value="Filsafat Keilahian" {{ old('study_program') == "Filsafat Keilahian" ? 'selected' : '' }}>Filsafat Keilahian</option>
                        <option value="Arsitektur" {{ old('study_program') == "Arsitektur" ? 'selected' : '' }}>Arsitektur</option>
                        <option value="Desain Produk" {{ old('study_program') == "Desain Produk" ? 'selected' : '' }}>Desain Produk</option>
                        <option value="Manajemen" {{ old('study_program') == "Manajemen" ? 'selected' : '' }}>Manajemen</option>
                        <option value="Akuntansi" {{ old('study_program') == "Akuntansi" ? 'selected' : '' }}>Akuntansi</option>
                        <option value="Biologi" {{ old('study_program') == "Biologi" ? 'selected' : '' }}>Biologi</option>
                        <option value="Informatika" {{ old('study_program') == "Informatika" ? 'selected' : '' }}>Informatika</option>
                        <option value="Sistem Informasi" {{ old('study_program') == "Sistem Informasi" ? 'selected' : '' }}>Sistem Informasi</option>
                        <option value="Kedokteran" {{ old('study_program') == "Kedokteran" ? 'selected' : '' }}>Kedokteran</option>
                        <option value="Profesi Dokter" {{ old('study_program') == "Profesi Dokter" ? 'selected' : '' }}>Profesi Dokter</option>
                        <option value="Pendidikan Bahasa Inggris" {{ old('study_program') == "Pendidikan Bahasa Inggris" ? 'selected' : '' }}>Pendidikan Bahasa Inggris</option>
                        <option value="Studi Humanitas" {{ old('study_program') == "Studi Humanitas" ? 'selected' : '' }}>Studi Humanitas</option>
                    </select>
                </div>
                <div class="col-md-6 p-left">
                    <input type="number" name="semester" class="form-control  @error('semester') is-invalid @enderror" placeholder="Angkatan" required>
                </div>
                <div class="col-md-6 p-right">
                    <input type="number" oninput="javascript: if (this.value.length > 16) this.value = this.value.slice(0, 16);" name="nik" class="form-control  @error('nik') is-invalid @enderror" placeholder="NIK" required>
                </div>
                <div class="col-md-6 p-left">
                    <input type="number" name="account_number" class="form-control  @error('account_number') is-invalid @enderror" placeholder="No Rekening (atas nama pribadi)" required>
                </div>
                <div class="col-md-6 p-right">
                    <input class="form-control" type="file" name="profile_picture" accept='image/jpeg , image/jpg, image/gif, image/png' placeholder="Pas Photo" required>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary btn-register">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection