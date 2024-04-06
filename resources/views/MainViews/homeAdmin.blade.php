@extends('MainViews.layouts.main')

@section('container')
<div class="content-wrapper mt-40" style="min-height: 798px;">
    <section class="content">
        <div class="container-fluid chart-view">
            <div class="row mb-3">
                <form action="/" method="get" class="row">
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="study_program">
                            Program Studi
                        </label>
                        <select class="custom-select" name="study_program" id="study_program">
                            <option value="" {{ $study_program == "" ? "selected" : "" }}>Semua</option>
                            <option value="Filsafat Keilahian" {{ $study_program == "Filsafat Keilahian" ? "selected" : "" }}>Filsafat Keilahian</option>
                            <option value="Arsitektur" {{ $study_program == "Arsitektur" ? "selected" : "" }}>Arsitektur</option>
                            <option value="Desain Produk" {{ $study_program == "Desain Produk" ? "selected" : "" }}>Desain Produk</option>
                            <option value="Manajemen" {{ $study_program == "Manajemen" ? "selected" : "" }}>Manajemen</option>
                            <option value="Akuntansi" {{ $study_program == "Akuntansi" ? "selected" : "" }}>Akuntansi</option>
                            <option value="Biologi" {{ $study_program == "Biologi" ? "selected" : "" }}>Biologi</option>
                            <option value="Informatika" {{ $study_program == "Informatika" ? "selected" : "" }}>Informatika</option>
                            <option value="Sistem Informasi" {{ $study_program == "Sistem Informasi" ? "selected" : "" }}>Sistem Informasi</option>
                            <option value="Kedokteran" {{ $study_program == "Kedokteran" ? "selected" : "" }}>Kedokteran</option>
                            <option value="Profesi Dokter" {{ $study_program == "Profesi Dokter" ? "selected" : "" }}> Profesi Dokter</option>
                            <option value="Pendidikan Bahasa Inggris" { $study_program=="Pendidikan Bahasa Inggris" ? "selected" : "" }}>Pendidikan Bahasa Inggris</option>
                            <option value="Studi Humanitas" {{ $study_program == "Studi Humanitas" ? "selected" : "" }}>Studi Humanitas</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="date">
                            Tahun Akademik
                        </label>
                        <select class="form-select" name="date">
                            <option value="" {{ $date == "" ? "selected" : "" }}>Semua</option>
                            @for ($i = 0; $i <= 7; $i++) <option value="{{ \Carbon\Carbon::now()->subYears($i)->year }}" {{ $date == \Carbon\Carbon::now()->subYears($i)->year ? "selected" : "" }}>
                                {{ \Carbon\Carbon::now()->subYears($i)->year }}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="achievement">
                            Capaian Peserta
                        </label>
                        <select class="form-select" name="achievement">
                            <option value="" {{ $achievement == "" ? "selected" : "" }}>Semua</option>
                            <option value="Pendaftar" {{ $achievement == "Pendaftar" ? "selected" : "" }}>Pendaftar</option>
                            <option value="Proposal" {{ $achievement == "Proposal" ? "selected" : "" }}>Proposal</option>
                            <option value="Didanai" {{ $achievement == "Didanai" ? "selected" : "" }}>Didanai</option>
                            <option value="Final" {{ $achievement == "Final" ? "selected" : "" }}>Final</option>
                            <option value="Juara 1" {{ $achievement == "Juara 1" ? "selected" : "" }}>Juara 1</option>
                            <option value="Juara 2" {{ $achievement == "Juara 2" ? "selected" : "" }}>Juara 2</option>
                            <option value="Juara 3" {{ $achievement == "Juara 3" ? "selected" : "" }}>Juara 3</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="d-inline word-break " for="category">
                            Kategori
                        </label>
                        <select class="form-select" name="category">
                            <option value="" {{ $category == "" ? "selected" : "" }}>Semua</option>
                            <option value="PUSPRESNAS" {{ $category == "PUSPRESNAS" ? "selected" : "" }}>PUSPRESNAS</option>
                            <option value="NON PUSPRESNAS REGIONAL" {{ $category == "NON PUSPRESNAS REGIONAL" ? "selected" : "" }}>NON PUSPRESNAS REGIONAL</option>
                            <option value="NON PUSPRESNAS NASIONAL" {{ $category == "NON PUSPRESNAS NASIONAL" ? "selected" : "" }}>NON PUSPRESNAS NASIONAL</option>
                            <option value="NON PUSPRESNAS INTERNASIONAL" {{ $category == "NON PUSPRESNAS INTERNASIONAL" ? "selected" : "" }}>NON PUSPRESNAS INTERNASIONAL</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-filter">
                        <i class="fa-solid fa-filter mr-2"></i>Filter
                    </button>
                </form>
            </div>
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="small-box bgprimary">
                        <p>Jumlah Mahasiswa Aktif</p>
                        <div class="inner">

                            <i class="fa-solid fa-users"></i>
                            <h3>{{ $users->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bgprimary">
                        <p>Jumlah Kompetisi UKDW</p>
                        <div class="inner">
                            <i class="fa-solid fa-newspaper"></i>
                            <h3>{{ $categories->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box bgprimary">
                        <p>Jumlah Prestasi UKDW</p>
                        <div class="inner">

                            <i class="fa-solid fa-trophy"></i>
                            <h3>
                                {{ $countAchievement }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <canvas id="myChart"></canvas>
                <canvas id="myChart2"></canvas>
            </div>
            <input type="hidden" name="studentCompetitions" id="studentCompetitions" value="{{ $studentCompetitions }}">
            <input type="hidden" name="users" id="users" value="{{ $users }}">
        </div>
    </section>
    <script>
        const ctx = document.getElementById('myChart');
        var studentCompetitions = JSON.parse(document.getElementById('studentCompetitions').value);
        var data = {
            labels: ['Proposal', 'Final', 'Juara 1', 'Juara 2', 'Juara 3', 'Didanai'],
            datasets: [{
                    label: 'FTI',
                    data: [
                        studentCompetitions.filter(x => x.achievement == 'Proposal' && x.faculty == 'Teknologi Informasi').length,
                        studentCompetitions.filter(x => x.achievement == 'Final' && x.faculty == 'Teknologi Informasi').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 1' && x.faculty == 'Teknologi Informasi').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 2' && x.faculty == 'Teknologi Informasi').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 3' && x.faculty == 'Teknologi Informasi').length,
                        studentCompetitions.filter(x => x.achievement == 'Didanai' && x.faculty == 'Teknologi Informasi').length,
                    ],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'FAD',
                    data: [
                        studentCompetitions.filter(x => x.achievement == 'Proposal' && x.faculty == 'Arsitektur').length,
                        studentCompetitions.filter(x => x.achievement == 'Final' && x.faculty == 'Arsitektur').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 1' && x.faculty == 'Arsitektur').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 2' && x.faculty == 'Arsitektur').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 3' && x.faculty == 'Arsitektur').length,
                        studentCompetitions.filter(x => x.achievement == 'Didanai' && x.faculty == 'Arsitektur').length,
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'FB',
                    data: [
                        studentCompetitions.filter(x => x.achievement == 'Proposal' && x.faculty == 'Bisnis').length,
                        studentCompetitions.filter(x => x.achievement == 'Final' && x.faculty == 'Bisnis').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 1' && x.faculty == 'Bisnis').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 2' && x.faculty == 'Bisnis').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 3' && x.faculty == 'Bisnis').length,
                        studentCompetitions.filter(x => x.achievement == 'Didanai' && x.faculty == 'Bisnis').length,
                    ],
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },
                {
                    label: 'FK',
                    data: [
                        studentCompetitions.filter(x => x.achievement == 'Proposal' && x.faculty == 'Kedokteran').length,
                        studentCompetitions.filter(x => x.achievement == 'Final' && x.faculty == 'Kedokteran').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 1' && x.faculty == 'Kedokteran').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 2' && x.faculty == 'Kedokteran').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 3' && x.faculty == 'Kedokteran').length,
                        studentCompetitions.filter(x => x.achievement == 'Didanai' && x.faculty == 'Kedokteran').length,
                    ],
                    backgroundColor: 'rgba(0, 255, 0, 0.2)',
                    borderColor: 'rgba(0, 255, 0, 1)',
                    borderWidth: 1
                },
                {
                    label: 'FKHum',
                    data: [
                        studentCompetitions.filter(x => x.achievement == 'Proposal' && x.faculty == 'Kependidikan dan Humaniora').length,
                        studentCompetitions.filter(x => x.achievement == 'Final' && x.faculty == 'Kependidikan dan Humaniora').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 1' && x.faculty == 'Kependidikan dan Humaniora').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 2' && x.faculty == 'Kependidikan dan Humaniora').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 3' && x.faculty == 'Kependidikan dan Humaniora').length,
                        studentCompetitions.filter(x => x.achievement == 'Didanai' && x.faculty =='Kependidikan dan Humaniora').length,
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Fabio',
                    data: [
                        studentCompetitions.filter(x => x.achievement == 'Proposal' && x.faculty == 'Bioteknologi').length,
                        studentCompetitions.filter(x => x.achievement == 'Final' && x.faculty == 'Bioteknologi').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 1' && x.faculty == 'Bioteknologi').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 2' && x.faculty == 'Bioteknologi').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 3' && x.faculty == 'Bioteknologi').length,
                        studentCompetitions.filter(x => x.achievement == 'Didanai' && x.faculty == 'Bioteknologi').length,
                    ],
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Ftheo',
                    data: [
                        studentCompetitions.filter(x => x.achievement == 'Proposal' && x.faculty == 'Teologi').length,
                        studentCompetitions.filter(x => x.achievement == 'Final' && x.faculty == 'Teologi').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 1' && x.faculty == 'Teologi').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 2' && x.faculty == 'Teologi').length,
                        studentCompetitions.filter(x => x.achievement == 'Juara 3' && x.faculty == 'Teologi').length,
                        studentCompetitions.filter(x => x.achievement == 'Didanai' && x.faculty == 'Teologi').length,
                    ],
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }
            ]
        };

        // Options
        var options = {
            scales: {
                xAxes: [{
                    stacked: true
                }],
                yAxes: [{
                    stacked: true
                }]
            },
            plugins: {
                title: {
                    display: true,
                    text: 'LEVEL KOMPETISI UKDW 2023'
                }
            },
            responsive: false,
            maintainAspectRatio: false,
            aspectRatio: 1,
        };
        // Chart
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var data = {
            labels: ['FTI', 'FAD', 'FB', 'FK', 'FKHum', 'Fabio', 'Ftheo'],
            datasets: [
                {
                    label: 'PUSPRESNAS',
                    data: [
                        studentCompetitions.filter(x => x.category == 'PUSPRESNAS' && x.faculty == 'Teknologi Informasi').length,
                        studentCompetitions.filter(x => x.category == 'PUSPRESNAS' && x.faculty == 'Arsitektur').length,
                        studentCompetitions.filter(x => x.category == 'PUSPRESNAS' && x.faculty == 'Bisnis ').length,
                        studentCompetitions.filter(x => x.category == 'PUSPRESNAS' && x.faculty == 'Kedokteran').length,
                        studentCompetitions.filter(x => x.category == 'PUSPRESNAS' && x.faculty == 'Kependidikan dan Humaniora').length,
                        studentCompetitions.filter(x => x.category == 'PUSPRESNAS' && x.faculty == 'Bioteknologi').length,
                        studentCompetitions.filter(x => x.category == 'PUSPRESNAS' && x.faculty == 'Teologi').length,
                    ],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'NON PUSPRESNAS REGIONAL',
                    data: [
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS REGIONAL' && x.faculty == 'Teknologi Informasi').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS REGIONAL' && x.faculty == 'Arsitektur').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS REGIONAL' && x.faculty == 'Bisnis ').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS REGIONAL' && x.faculty == 'Kedokteran').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS REGIONAL' && x.faculty =='Kependidikan dan Humaniora').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS REGIONAL' && x.faculty == 'Bioteknologi').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS REGIONAL' && x.faculty == 'Teologi').length,
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'NON PUSPRESNAS NASIONAL',
                    data: [
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS NASIONAL' && x.faculty == 'Teknologi Informasi').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS NASIONAL' && x.faculty == 'Arsitektur').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS NASIONAL' && x.faculty == 'Bisnis ').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS NASIONAL' && x.faculty == 'Kedokteran').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS NASIONAL' && x.faculty == 'Kependidikan dan Humaniora').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS NASIONAL' && x.faculty == 'Bioteknologi').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS NASIONAL' && x.faculty == 'Teologi').length,
                    ],
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'NON PUSPRESNAS INTERNASIONAL',
                    data: [
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS INTERNASIONAL' && x.faculty == 'Teknologi Informasi').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS INTERNASIONAL' && x.faculty == 'Arsitektur').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS INTERNASIONAL' && x.faculty == 'Bisnis ').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS INTERNASIONAL' && x.faculty == 'Kedokteran').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS INTERNASIONAL' && x.faculty =='Kependidikan dan Humaniora').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS INTERNASIONAL' && x.faculty == 'Bioteknologi').length,
                        studentCompetitions.filter(x => x.category == 'NON PUSPRESNAS INTERNASIONAL' && x.faculty == 'Teologi').length,
                    ],
                    backgroundColor: 'rgba(0, 255, 0, 0.2)',
                    borderColor: 'rgba(0, 255, 0, 1)',
                    borderWidth: 1,
                    fill: false
                }
            ]
        };
        var options2 = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            plugins: {
                title: {
                    display: true,
                    text: 'CAPAIAN KOMPETISI UKDW 2023'
                }
            },
            responsive: false,
            maintainAspectRatio: false,
            aspectRatio: 1,
        };

        // Chart
        var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: data,
            options: options2
        });
    </script>
</div>
@endsection