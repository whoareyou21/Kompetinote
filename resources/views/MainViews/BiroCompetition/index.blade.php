@extends('MainViews.layouts.main')

@section('container')
<div class="content-wrapper mt-40" style="min-height: 798px;">
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <form action="/dashboard/validations" method="get" class="row">
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="study_program">
                            Program Studi
                        </label>
                        <select class="custom-select" name="study_program" id="study_program">
                            <option value="Filsafat Keilahian" {{ old('study_program', $study_program) == "Filsafat Keilahian" ? 'selected' : '' }}>Filsafat Keilahian</option>
                            <option value="Arsitektur" {{ old('study_program', $study_program) == "Arsitektur" ? 'selected' : '' }}>Arsitektur</option>
                            <option value="Desain Produk" {{ old('study_program', $study_program) == "Desain Produk" ? 'selected' : '' }}>Desain Produk</option>
                            <option value="Manajemen" {{ old('study_program', $study_program) == "Manajemen" ? 'selected' : '' }}>Manajemen</option>
                            <option value="Akuntansi" {{ old('study_program', $study_program) == "Akuntansi" ? 'selected' : '' }}>Akuntansi</option>
                            <option value="Biologi" {{ old('study_program', $study_program) == "Biologi" ? 'selected' : '' }}>Biologi</option>
                            <option value="Informatika" {{ old('study_program', $study_program) == "Informatika" ? 'selected' : '' }}>Informatika</option>
                            <option value="Sistem Informasi" {{ old('study_program', $study_program) == "Sistem Informasi" ? 'selected' : '' }}>Sistem Informasi</option>
                            <option value="Kedokteran" {{ old('study_program', $study_program) == "Kedokteran" ? 'selected' : '' }}>Kedokteran</option>
                            <option value="Profesi Dokter" {{ old('study_program', $study_program) == "Profesi Dokter" ? 'selected' : '' }}>Profesi Dokter</option>
                            <option value="Pendidikan Bahasa Inggris" {{ old('study_program', $study_program) == "Pendidikan Bahasa Inggris" ? 'selected' : '' }}>Pendidikan Bahasa Inggris</option>
                            <option value="Studi Humanitas" {{ old('study_program', $study_program) == "Studi Humanitas" ? 'selected' : '' }}>Studi Humanitas</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label class="d-inline word-break " for="semester">
                            Angkatan
                        </label>
                        <input type="number" name="semester" min="{{ \Carbon\Carbon::now()->subYears(7)->year }}" max="{{ \Carbon\Carbon::now()->year }}" step="1" class="form-control  @error('semester') is-invalid @enderror" placeholder="{{ \Carbon\Carbon::now()->year }}" value="{{ old('semester', $semester) }}">
                    </div>
                    <div class="col-md-1">
                        <label class="d-inline word-break " for="date">
                            Tahun
                        </label>
                        <input type="number" name="date" min="{{ \Carbon\Carbon::now()->subYears(7)->year }}" max="{{ \Carbon\Carbon::now()->year }}" step="1" class="form-control  @error('date') is-invalid @enderror" placeholder="{{ \Carbon\Carbon::now()->year }}" value="{{ old('date', $date) }}">
                    </div>
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="activity_type">
                            Jenis Kepesertaan
                        </label>
                        <select class="form-select" name="activity_type">
                            <option value="Individu" {{ old('activity_type', $activity_type) == "Individu" ? 'selected' : '' }}>Individu</option>
                            <option value="Kelompok" {{ old('activity_type', $activity_type) == "Kelompok" ? 'selected' : '' }}>Kelompok</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="achievement">
                            Capaian Peserta
                        </label>
                        <select class="form-select" name="achievement">
                            <option value="Pendaftar" {{ old('achievement', $achievement) == "Pendaftar" ? 'selected' : '' }}>Pendaftar</option>
                            <option value="Proposal" {{ old('achievement', $achievement) == "Proposal" ? 'selected' : '' }}>Proposal</option>
                            <option value="Didanai" {{ old('achievement', $achievement) == "Didanai" ? 'selected' : '' }}>Didanai</option>
                            <option value="Final" {{ old('achievement', $achievement) == "Final" ? 'selected' : '' }}>Final</option>
                            <option value="Juara 1" {{ old('achievement', $achievement) == "Juara 1" ? 'selected' : '' }}>Juara 1</option>
                            <option value="Juara 2" {{ old('achievement', $achievement) == "Juara 2" ? 'selected' : '' }}>Juara 2</option>
                            <option value="Juara 3" {{ old('achievement', $achievement) == "Juara 3" ? 'selected' : '' }}>Juara 3</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="category">
                            Kategori
                        </label>
                        <select class="form-select" name="category">
                            <option value="PUSPRESNAS" {{ old('category', $category) == "PUSPRESNAS" ? 'selected' : '' }}>PUSPRESNAS</option>
                            <option value="NON PUSPRESNAS REGIONAL" {{ old('category', $category) == "NON PUSPRESNAS REGIONAL" ? 'selected' : '' }}>NON PUSPRESNAS REGIONAL</option>
                            <option value="NON PUSPRESNAS NASIONAL" {{ old('category', $category) == "NON PUSPRESNAS NASIONAL" ? 'selected' : '' }}>NON PUSPRESNAS NASIONAL</option>
                            <option value="NON PUSPRESNAS INTERNASIONAL" {{ old('category', $category) == "NON PUSPRESNAS INTERNASIONAL" ? 'selected' : '' }}>NON PUSPRESNAS INTERNASIONAL</option>
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
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Nama Kompetisi</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Capaian Peserta</th>
                            <th scope="col">Bukti Dokumen</th>
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($competitions->count())
                        @foreach ($competitions as $competition)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $competition->name }}</td>
                            <td>{{ $competition->activity_name }}</td>
                            <td>{{ $competition->end_date }}</td>
                            <td>{{ $competition->achievement }}</td>
                            <td>
                                <a href="/dashboard/validations/{{ $competition->id }}/download" class="badge"><i class="fa-solid fa-download icon-style"></i></a>
                            </td>
                            <td>
                                <button class="badge bg-success border-0 update-approve" data-id="/validations/{{ $competition->id }}/approve"></i><span class="ml4">Setuju</span></button>
                                <button class="badge bg-danger border-0 update-reject" data-id="/validations/{{ $competition->id }}/reject"><span class="ml4">Ditolak</span></button>
                            </td>
                            <td>
                                <a href="/dashboard/validations/{{ $competition->id }}/edit" class="badge"><i class="fa-solid fa-pen-to-square icon-style cgreen"></i></a>
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <button class="badge border-0 delete-confirm" data-id="/validations/{{ $competition->id }}"><i class="fa-solid fa-trash icon-style cred"></i></button>
                            </td>
                        </tr>
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