@extends('MainViews.layouts.main')

@section('container')
<div class="content-wrapper" style="min-height: 798px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Form Set Up Data Kompetisi</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-8">
                    <form method="post" action="/dashboard/settings/{{ $data->id }}" class="mb-5">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori*</label>
                            <select class="form-select" name="category">
                                <option value="PUSPRESNAS" {{ old('category', $data->category) == "PUSPRESNAS" ? 'selected' : '' }}>PUSPRESNAS</option>
                                <option value="NON PUSPRESNAS REGIONAL" {{ old('category', $data->category) == "NON PUSPRESNAS REGIONAL" ? 'selected' : '' }}>NON PUSPRESNAS REGIONAL</option>
                                <option value="NON PUSPRESNAS NASIONAL" {{ old('category', $data->category) == "NON PUSPRESNAS NASIONAL" ? 'selected' : '' }}>NON PUSPRESNAS NASIONAL</option>
                                <option value="NON PUSPRESNAS INTERNASIONAL" {{ old('category', $data->category) == "NON PUSPRESNAS INTERNASIONAL" ? 'selected' : '' }}>NON PUSPRESNAS INTERNASIONAL</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="activity_type" class="form-label">Jenis Kepesertaan*</label>
                            <select class="form-select" name="activity_type">
                                <option value="Individu" {{ old('activity_type', $data->activity_type) == "Individu" ? 'selected' : '' }}>Individu</option>
                                <option value="Kelompok" {{ old('activity_type', $data->activity_type) == "Kelompok" ? 'selected' : '' }}>Kelompok</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="activity_level" class="form-label">Tingkat Kegiatan*</label>
                            <select class="form-select" name="activity_level">
                                <option value="Provinsi/Wilayah" {{ old('activity_level', $data->activity_level) == "Provinsi/Wilayah" ? 'selected' : '' }}>Provinsi/Wilayah</option>
                                <option value="Nasional" {{ old('activity_level', $data->activity_level) == "Nasional" ? 'selected' : '' }}>Nasional</option>
                                <option value="Internasional" {{ old('activity_level', $data->activity_level) == "Internasional" ? 'selected' : '' }}>Internasional</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="activity_name" class="form-label">Nama Kegiatan*</label>
                            <input type="text" class="form-control @error('activity_name') is-invalid @enderror" id="activity_name"
                                name="activity_name" autofocus value="{{ old('activity_name', $data->activity_name) }}">
                            @error('activity_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="activity_year" class="form-label">Tahun Kegiatan*</label>
                            <input type="number" name="activity_year" min="{{ \Carbon\Carbon::now()->subYears(7)->year }}" max="{{ \Carbon\Carbon::now()->year }}" step="1" class="form-control  @error('activity_year') is-invalid @enderror" placeholder="{{ \Carbon\Carbon::now()->year }}" value="{{ old('activity_year', $data->activity_year) }}">
                            @error('activity_year')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="wrp-button">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
