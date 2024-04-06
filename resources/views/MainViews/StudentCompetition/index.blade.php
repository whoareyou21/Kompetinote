@extends('MainViews.layouts.main')

@section('container')
<div class="content-wrapper mt-40" style="min-height: 798px;">
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-12">
                    <a href="/dashboard/student/competition/create" class="btn btn-primary btn-filter fright">
                        <i class="fa-solid fa-plus mr-2"></i>Add New
                    </a>
                </div>
            </div>
            <div class="row mb-3">
                <form action="/dashboard/student/competition" method="get" class="row">
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="name">
                            Nama Kegiatan
                        </label>
                        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror"
                            placeholder="Nama Kegiatan">
                    </div>
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="year">
                            Waktu
                        </label>
                        <input type="number" name="year" min="2020" max="2024" step="1"
                            class="form-control  @error('year') is-invalid @enderror" placeholder="2020">
                    </div>
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="achievement">
                            Capaian Peserta
                        </label>
                        <select class="custom-select" name="achievement">
                            <option value="Pendaftar">Pendaftar</option>
                            <option value="Proposal">Proposal</option>    
                            <option value="Didanai">Didanai</option>
                            <option value="Final">Final</option>
                            <option value="Juara 1">Juara 1</option>
                            <option value="Juara 2">Juara 2</option>
                            <option value="Juara 3">Juara 3</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="category">
                            Kategori
                        </label>
                        <select class="custom-select" name="category">
                            <option value="PUSPRESNAS">PUSPRESNAS</option>
                            <option value="NON PUSPRESNAS REGIONAL">NON PUSPRESNAS REGIONAL</option>
                            <option value="NON PUSPRESNAS NASIONAL">NON PUSPRESNAS NASIONAL</option>
                            <option value="NON PUSPRESNAS INTERNASIONAL">NON PUSPRESNAS INTERNASIONAL
                            </option>
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
                            <th scope="col">Nama Kompetisi</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Capaian Peserta</th>
                            <th scope="col">Tingkat</th>
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($competitions->count())
                        @foreach ($competitions as $competition)
                        @if ($competition->category != null)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $competition->category->activity_name }}</td>
                            <td>{{ $competition->start_date }}</td>
                            <td>{{ $competition->achievement }}</td>
                            <td>{{ $competition->category->activity_level }}</td>
                            @if ($competition->status == 0)
                            <td>Menunggu Persetujuan</td>
                            @elseif ($competition->status == 1)
                            <td>Disetujui</td>
                            @else
                            <td>Ditolak</td>
                            @endif
                            <td>{{ $competition->rejection_note }}</td>
                            <td>
                                <a href="/dashboard/student/competition/{{ $competition->id }}/edit" class="badge"><i
                                        class="fa-solid fa-pen-to-square icon-style cgreen"></i></a>
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <button class="badge border-0 delete-confirm"
                                    data-id="/student/competition/{{ $competition->id }}"><i
                                        class="fa-solid fa-trash icon-style cred"></i></button>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8" class="text-center ">
                                <span class="fs-4 fw-bold">Belum Ada Data Kompetisi</span>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $competitions->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection