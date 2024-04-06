@extends('MainViews.layouts.main')

@section('container')
<div class="content-wrapper mt-40" style="min-height: 798px;">
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-12">
                    <a href="/dashboard/settings/create" class="btn btn-primary btn-filter fright">
                        <i class="fa-solid fa-plus mr-2"></i>Add New
                    </a>
                </div>
            </div>
            <div class="row mb-3">
                <form action="/dashboard/settings" method="get" class="row">
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="activity_type">
                            Jenis Kepesertaan
                        </label>
                        <select class="custom-select" name="activity_type">
                            <option value="">Semua</option>
                            <option value="Individu">Individu</option>
                            <option value="Kelompok">Kelompok</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="activity_level">
                            Tingkat Kegiatan
                        </label>
                        <select class="custom-select" name="activity_level">
                            <option value="">Semua</option>
                            <option value="Provinsi/Wilayah">Provinsi/Wilayah</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Internasional">Internasional</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="category">
                            Kategori
                        </label>
                        <select class="custom-select" name="category">
                            <option value="">Semua</option>
                            <option value="PUSPRESNAS">PUSPRESNAS</option>
                            <option value="NON PUSPRESNAS REGIONAL">NON PUSPRESNAS REGIONAL</option>
                            <option value="NON PUSPRESNAS NASIONAL">NON PUSPRESNAS NASIONAL</option>
                            <option value="NON PUSPRESNAS INTERNASIONAL">NON PUSPRESNAS INTERNASIONAL</option>
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
                            <th scope="col">Nama Kegiatan</th>
                            <th scope="col">Tingkat Kegiatan</th>
                            <th scope="col">Jenis Kepesertaan</th>
                            <th scope="col">Kategori</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($settings->count())
                        @foreach ($settings as $setting)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $setting->activity_name }}</td>
                            <td>{{ $setting->activity_level }}</td>
                            <td>{{ $setting->activity_type }}</td>
                            <td>{{ $setting->category }}</td>
                            <td class="text-center">
                                <a href="/dashboard/settings/{{ $setting->id }}/edit" class="badge"><i class="fa-solid fa-pen-to-square icon-style cgreen"></i></a>
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <button class="badge border-0 delete-confirm" data-id="/settings/{{ $setting->id }}"><i class="fa-solid fa-trash icon-style cred"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8" class="text-center ">
                                <span class="fs-4 fw-bold">Belum Ada Data Setting</span>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $settings->links() }}
                </div>
            </div>

        </div>
    </section>
</div>
@endsection