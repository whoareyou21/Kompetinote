@extends('MainViews.layouts.main')

@section('container')
<div class="content-wrapper" style="min-height: 798px;">
    <div class="content-header mt-40">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Form Pengajuan Kompetisi</h1>
                    <h6>*wajib diisi</h6>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif
    <section class="content">
        <input type="hidden" id="valuecategories" value="{{ $categories }}">
        <input type="hidden" id="valuelectures" value="{{ $lectures }}">

        <div class="container-fluid add-form">
            <div class="row">
                <div class="col-lg-8">
                    <form method="post" action="/dashboard/validations/{{ $data->id }}" class="mb-5" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" id="category_id" name="category_id" value="{{ $data->category_id }}">
                        <input type="hidden" id="supervisor_id" name="supervisor_id" value="{{ $data->supervisor_id }}">
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label class="d-inline word-break form-label" for="activity_name">
                                    Nama Kegiatan*
                                </label>
                                <input type="text" class="form-control @error('activity_name') is-invalid @enderror" id="addactivity_name" name="activity_name" autofocus value="{{ old('activity_name', $data->category->activity_name) }}" required>
                                <div id="suggesstion-box-activity"></div>
                                @error('activity_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label class="d-inline word-break form-label" for="activity_level">
                                    Tingkat Kegiatan*
                                </label>
                                <div class="form-inline align-items-start felement">
                                    <select class="custom-select" name="activity_level" id="activity_level" disabled>
                                        <option value="Provinsi/Wilayah" {{ $data->category->activity_level == "Provinsi/Wilayah" ? "selected" : '' }}>Provinsi/Wilayah</option>
                                        <option value="Nasional" {{ $data->category->activity_level == "Nasional" ? "selected" : '' }}>Nasional</option>
                                        <option value="Internasional" {{ $data->category->activity_level == "Internasional" ? "selected" : '' }}>Internasional</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-4">
                                <label class="d-inline word-break form-label" for="category">
                                    Kategori*
                                </label>
                                <div class="form-inline align-items-start felement">
                                    <select class="custom-select" name="category" id="category" disabled>
                                        <option value="PUSPRESNAS" {{ $data->category->category == "PUSPRESNAS" ? "selected" : '' }}>PUSPRESNAS</option>
                                        <option value="NON PUSPRESNAS REGIONAL" {{ $data->category->category == "NON PUSPRESNAS REGIONAL" ? "selected" : '' }}>NON PUSPRESNAS REGIONAL</option>
                                        <option value="NON PUSPRESNAS NASIONAL" {{ $data->category->category == "NON PUSPRESNAS NASIONAL" ? "selected" : '' }}>NON PUSPRESNAS NASIONAL</option>
                                        <option value="NON PUSPRESNAS INTERNASIONAL" {{ $data->category->category == "NON PUSPRESNAS INTERNASIONAL" ? "selected" : '' }}>NON PUSPRESNAS INTERNASIONAL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="d-inline word-break form-label" for="achievement">
                                    Capaian Peserta*
                                </label>
                                <div class="form-inline align-items-start felement">
                                    <select class="custom-select" name="achievement" id="achievement">
                                        <option value="Juara 1" {{ $data->achievement == "Juara 1" ? "selected" : '' }}>Juara 1</option>
                                        <option value="Juara 2" {{ $data->achievement == "Juara 2" ? "selected" : '' }}>Juara 2</option>
                                        <option value="Juara 3" {{ $data->achievement == "Juara 3" ? "selected" : '' }}>Juara 3</option>
                                        <option value="Didanai" {{ $data->achievement == "Didanai" ? "selected" : '' }}>Didanai</option>
                                        <option value="Proposal" {{ $data->achievement == "Proposal" ? "selected" : '' }}>Proposal</option>
                                        <option value="Final" {{ $data->achievement == "Final" ? "selected" : '' }}>Final</option>
                                        <option value="Pendaftar" {{ $data->achievement == "Pendaftar" ? "selected" : '' }}>Pendaftar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label for="activity_year" class="d-inline word-break form-label">Tahun Kegiatan</label>
                                <input type="number" class="form-control @error('activity_year') is-invalid @enderror" id="activity_year" name="activity_year" autofocus value="{{ old('activity_year', $data->category->activity_year) }}" required disabled>
                                @error('activity_year')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-4">
                            <div class="col-lg-4">
                                <label class="d-inline word-break form-label" for="activity_type">
                                    Jenis Kepesertaan*
                                </label>
                                <div class="form-inline align-items-start felement">
                                    <select class="custom-select" name="activity_type" id="input_activity_type" disabled>
                                        <option value="Individu" {{ $data->category->activity_type == "Individu" ? "selected" : '' }}>Individu</option>
                                        <option value="Kelompok" {{ $data->category->activity_type == "Kelompok" ? "selected" : '' }}>Kelompok</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label for="start_date" class="d-inline word-break form-label">Tanggal Mulai*</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" autofocus value="{{ old('start_date', $data->start_date) }}" required>
                                @error('start_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="end_date" class="d-inline word-break form-label">Tanggal Selesai*</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" autofocus value="{{ old('end_date', $data->end_date) }}" required>
                                @error('end_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- START GROUP -->
                        <div class="type-group">
                            <div class="row mb-4">
                                <div class="col-lg-3">
                                    <label class="d-inline word-break form-label" for="participant_number">
                                        Jumlah Peserta
                                    </label>
                                    <input type="number" class="form-control @error('participant_number') is-invalid @enderror" id="participant_number" name="participant_number" autofocus value="{{ old('participant_number', $data->participant_number) }}">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="d-inline word-break form-label">
                                        Nama Ketua Kelompok
                                    </label>
                                    <input type="text" class="form-control" id="leader" name="leader" autofocus value="{{ $data->leader->name }}" disabled>
                                </div>
                                <div class="col-lg-6">
                                    <label class="d-inline word-break form-label">
                                        NIM Ketua Kelompok
                                    </label>
                                    <input type="text" class="form-control" id="leader_nim" name="leader_nim" autofocus value="{{ $data->leader->nim }}" disabled>
                                    @error('leader_nim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <label class="d-inline word-break form-label" for="members">
                                        Nama Anggota
                                    </label>
                                    <textarea class="form-control" class="namaanggota" id="namaanggota" name="members" rows="4" value="{{ $data->members }}">{{ $data->members }}</textarea>
                                    @error('members')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label class="d-inline word-break form-label" for="members_nim">
                                        NIM Anggota
                                    </label>
                                    <textarea class="form-control" class="nimanggota" id="nimanggota" name="members_nim" rows="4" value="{{ $data->members_nim }}">{{ $data->members_nim }}</textarea>
                                    @error('members_nim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- END GROUP -->
                        <div class="row mb-4">
                            <div class="col-lg-4">
                                <label class="d-inline word-break form-label" for="supervisor">
                                    Dosen Pembimbing
                                </label>
                                <input type="text" class="form-control @error('supervisor') is-invalid @enderror" id="addsupervisor" name="supervisor" autofocus value="{{ old('supervisor', $data->lecture != null ? $data->lecture->name : null) }}">
                                <div id="suggesstion-box-lecture"></div>
                            </div>
                            <div class="col-lg-4">
                                <label class="d-inline word-break form-label" for="supervisor_nik">
                                    NIK/NIDN/NIDN Dosen
                                </label>
                                <input type="text" class="form-control @error('supervisor_nik') is-invalid @enderror" id="supervisor_nik" name="supervisor_nik" autofocus value="{{ old('supervisor_nik', $data->lecture != null ? $data->lecture->nik : null) }}" disabled>
                                @error('supervisor_nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label class="d-inline word-break form-label" for="assignment_letter">
                                    Surat Tugas Dosen
                                </label>
                                <input type="file" class="form-control @error('assignment_letter') is-invalid @enderror" id="assignment_letter" name="assignment_letter" autofocus value="{{ old('assignment_letter') }}">
                                @error('assignment_letter')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label class="d-inline word-break form-label" for="certificate">
                                    Dokumen Pendukung Sertifikat Apresiasi atau Karya
                                </label>
                                <input type="file" class="form-control @error('certificate') is-invalid @enderror" accept="application/pdf" id="certificate" name="certificate" autofocus value="{{ old('certificate') }}">
                                <span>*File dalam format PDF. Jika dokumen lebih dari satu file bisa digabung dalam 1 File dengan ukuran max 5 MB</span>
                                @error('certificate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label class="d-inline word-break form-label" for="organizer_url">
                                    URL penyelenggara*
                                </label>
                                <input type="text" class="form-control @error('organizer_url') is-invalid @enderror" id="organizer_url" name="organizer_url" autofocus value="{{ old('organizer_url', $data->organizer_url) }}" required>
                                <span>URL Laman penyelenggara, URL Media Sosial Panitia atau URL Berita Pada Surat Kabar.</span>
                                @error('organizer_url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label class="d-inline word-break form-label" for="handover">
                                    Foto Penyerahan Sertifikat Apresiasi*
                                </label>
                                <input type="file" class="form-control @error('handover') is-invalid @enderror" accept="application/pdf" id="handover" name="handover" autofocus value="{{ old('handover') }}" required>
                                <span>*File dalam format PDF. Jika dokumen lebih dari satu file bisa digabung dalam 1 File dengan ukuran max 5 MB</span>
                                @error('handover')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label class="d-inline word-break form-label" for="other_document">
                                    Dokumen Pendukung Lainnya*
                                </label>
                                <input type="file" class="form-control @error('other_document') is-invalid @enderror" accept="application/pdf" id="other_document" name="other_document" autofocus value="{{ old('other_document') }}" required>
                                <span>Unggah pindaian surat undangan/invitasi, undangan kegiatan atau surat tugas dari institusi PT.<br>*File dalam format PDF. Jika dokumen lebih dari satu file bisa digabung dalam 1 File dengan ukuran max 5 MB</span>
                                @error('other_document')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label class="d-inline word-break form-label" for="description">
                                    Keterangan
                                </label>
                                <textarea class="form-control" class="description" id="description" name="description" rows="4" value="{{ $data->description }}"></textarea>
                                <span>Silahkan bisa menambahkan informasi tambahan jika diperlukan. Beri tanda (-) jika tidak ada keterangan tambahan.</span>
                                @error('achievement')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="wrp-button">
                            <button type="submit" class="btn btn-primary btn-save"><i class="fa-solid fa-floppy-disk mr-2"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>

</script>
@endsection