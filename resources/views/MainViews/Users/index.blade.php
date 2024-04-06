@extends('MainViews.layouts.main')

@section('container')
<div class="content-wrapper mt-40" style="min-height: 798px;">
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-12">
                    <a href="/dashboard/users/create" class="btn btn-primary btn-filter fright">
                        <i class="fa-solid fa-plus mr-2"></i>Add New
                    </a>
                </div>
            </div>
            <div class="row mb-3">
                <form action="/dashboard/users" method="get" class="row">
                    <div class="col-md-4">
                        <label class="d-inline word-break " for="name">
                            Nama
                        </label>
                        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Nama" value="{{ $name }}">
                    </div>
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="role">
                            Role
                        </label>
                        <select class="custom-select" name="role">
                        <option value="">Semua</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role', $role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-filter">
                        <i class="fa-solid fa-filter mr-2"></i>Filter
                    </button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIK/NIDN</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->count())
                        @foreach ($users as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nim }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->campus_email }}</td>
                            <td>{{ $data->role->name }}</td>
                            <td class="text-center">
                                <a href="/dashboard/users/{{ $data->id }}/edit" class="badge"><i class="fa-solid fa-pen-to-square icon-style cgreen"></i></a>
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <button class="badge border-0 delete-confirm" data-id="/users/{{ $data->id }}"><i class="fa-solid fa-trash icon-style cred"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8" class="text-center ">
                                <span class="fs-4 fw-bold">Belum Ada Data User</span>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </section>
</div>
@endsection