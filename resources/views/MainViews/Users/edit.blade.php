@extends('MainViews.layouts.main')

@section('container')
<div class="content-wrapper mt-40" style="min-height: 798px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Pengguna</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <form method="post" action="/dashboard/users/{{ $data->id }}" class="mb-5" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label d-flex">
                                <label for="name" class="form-label">Nama</label>
                            </div>
                            <div class="col-md-3 align-items-start">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus value="{{ old('name', $data->name) }}">
                            </div>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label d-flex">
                                <label for="nim" class="form-label">NIM/NIDN</label>
                            </div>
                            <div class="col-md-3 align-items-start">
                                <input maxlength="8" type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" autofocus value="{{ old('nim', $data->nim) }}">
                            </div>
                            @error('nim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label d-flex">
                                <label for="password" class="form-label">Password</label>
                            </div>
                            <div class="col-md-3 align-items-start input-password input-passuser">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autofocus>
                                <i id="togglePassword" class="fa fa-eye" aria-hidden="true"></i>
                            </div>
                            @error('nim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label d-flex">
                                <label for="phone_number" class="form-label">No Telepon / HP</label>
                            </div>
                            <div class="col-md-3 align-items-start">
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" autofocus value="{{ old('phone_number', $data->phone_number) }}">
                            </div>
                            @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label d-flex">
                                <label for="personal_email" class="form-label">Email Pribadi</label>
                            </div>
                            <div class="col-md-3 align-items-start">
                                <input type="email" class="form-control @error('personal_email') is-invalid @enderror" id="personal_email" name="personal_email" autofocus value="{{ old('personal_email', $data->personal_email) }}">
                            </div>
                            @error('personal_email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label d-flex">
                                <label for="campus_email" class="form-label">Email Students</label>
                            </div>
                            <div class="col-md-3 d-block">
                                <input type="email" class="form-control @error('campus_email') is-invalid @enderror" id="campus_email" name="campus_email" autofocus value="{{ old('campus_email', $data->campus_email) }}">
                                <div class="emailHelp" id="emailHelp"></div>
                            </div>
                            @error('campus_email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label d-flex">
                                <label for="faculty" class="form-label">Fakultas</label>
                            </div>
                            <div class="col-md-3 align-items-start felement">
                                <select class="custom-select" name="faculty" id="faculty">
                                    <option value="Teologi" {{ old('faculty', $data->faculty) == "Teologi" ? 'selected' : '' }}>Teologi</option>
                                    <option value="Arsitektur" {{ old('faculty', $data->faculty) == "Arsitektur" ? 'selected' : '' }}>Arsitektur</option>
                                    <option value="Bioteknologi" {{ old('faculty', $data->faculty) == "Bioteknologi" ? 'selected' : '' }}>Bioteknologi</option>
                                    <option value="Bisnis" {{ old('faculty', $data->faculty) == "Bisnis" ? 'selected' : '' }}>Bisnis</option>
                                    <option value="Teknologi Informasi" {{ old('faculty', $data->faculty) == "Teknologi Informasi" ? 'selected' : '' }}>Teknologi Informasi</option>
                                    <option value="Kedokteran" {{ old('faculty', $data->faculty) == "Kedokteran" ? 'selected' : '' }}>Kedokteran</option>
                                    <option value="Kependidikan dan Humaniora" {{ old('faculty', $data->faculty) == "Kependidikan dan Humaniora" ? 'selected' : '' }}>Kependidikan dan Humaniora</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label d-flex">
                                <label for="study_program" class="form-label">Program Studi</label>
                            </div>
                            <div class="col-md-3 align-items-start felement">
                                <select class="custom-select" name="study_program" id="study_program">
                                    <option value="Filsafat Keilahian" {{ old('study_program', $data->study_program) == "Filsafat Keilahian" ? 'selected' : '' }}>Filsafat Keilahian</option>
                                    <option value="Arsitektur" {{ old('study_program', $data->study_program) == "Arsitektur" ? 'selected' : '' }}>Arsitektur</option>
                                    <option value="Desain Produk" {{ old('study_program', $data->study_program) == "Desain Produk" ? 'selected' : '' }}>Desain Produk</option>
                                    <option value="Manajemen" {{ old('study_program', $data->study_program) == "Manajemen" ? 'selected' : '' }}>Manajemen</option>
                                    <option value="Akuntansi" {{ old('study_program', $data->study_program) == "Akuntansi" ? 'selected' : '' }}>Akuntansi</option>
                                    <option value="Biologi" {{ old('study_program', $data->study_program) == "Biologi" ? 'selected' : '' }}>Biologi</option>
                                    <option value="Informatika" {{ old('study_program', $data->study_program) == "Informatika" ? 'selected' : '' }}>Informatika</option>
                                    <option value="Sistem Informasi" {{ old('study_program', $data->study_program) == "Sistem Informasi" ? 'selected' : '' }}>Sistem Informasi</option>
                                    <option value="Kedokteran" {{ old('study_program', $data->study_program) == "Kedokteran" ? 'selected' : '' }}>Kedokteran</option>
                                    <option value="Pendidikan Bahasa Inggris" {{ old('study_program', $data->study_program) == "Pendidikan Bahasa Inggris" ? 'selected' : '' }}>Pendidikan Bahasa Inggris</option>
                                    <option value="Studi Humanitas" {{ old('study_program', $data->study_program) == "Studi Humanitas" ? 'selected' : '' }}>Studi Humanitas</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label d-flex">
                                <label for="semester" class="form-label">Angkatan</label>
                            </div>
                            <div class="col-md-3 align-items-start">
                                <input type="text" class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester" autofocus value="{{ old('semester', $data->semester) }}">
                            </div>
                            @error('semester')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label d-flex">
                                <label for="nik" class="form-label">NIK</label>
                            </div>
                            <div class="col-md-3 align-items-start">
                                <input maxlength="16" type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" autofocus value="{{ old('nik', $data->nik) }}">
                            </div>
                            @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label d-flex">
                                <label for="account_number" class="form-label">No Rekening</label>
                            </div>
                            <div class="col-md-3 align-items-start">
                                <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" name="account_number" autofocus value="{{ old('account_number', $data->account_number) }}">
                            </div>
                            @error('account_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label d-flex">
                                <label class="d-inline word-break " for="role_id">
                                    Role
                                </label>
                            </div>
                            <div class="col-md-3 align-items-start felement">
                                <select class="custom-select" name="role_id" id="role_id">
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id == $data->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('account_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 col-form-label d-flex">
                                <label class="d-inline word-break " for="profile_picture">Foto Profile</label>
                            </div>
                            <div class="col-md-3 align-items-start">
                                <input class="form-control" type="file" name="profile_picture" accept='image/jpeg , image/jpg, image/gif, image/png' placeholder="Pas Photo">
                            </div>
                            @error('profile_picture')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="wrp-button">
                            <button type="submit" class="btn btn-primary btn-save fleft"><i class="fa-solid fa-floppy-disk mr-2"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection