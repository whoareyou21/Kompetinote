<style>
    .content-header table,.content-header th,.content-header tr,.content-header td {border: none;}
    .main-content table,.main-content  th,.main-content  tr,.main-content td {border: solid 1px black;font-size: 14px;}
    td,th {padding:4px 8px;}
    .content-header td {padding:0px 8px;border: none;font-size: 14px;}
    .footer{margin-top:110px;margin-left: 350px;text-align: right;}
    .footer span{margin-left: 44px;font-size:12px;}
    .footer .signature{margin-top:80px;}
    .footer .line{border-bottom: 1px solid #414141;width:198px;}
</style>
<h4 style="text-align:center;">LAPORAN DOKUMENTASI PRESTASI KOMPETISI MAHASISWA<br>UNIVERSITAS KRISTEN DUTA WACANA <br>{{ !empty($date) ? "TAHUN " . $date : "" }}</h4>
<table class="content-header" cellspacing="0">
<thead>
  <tr>
    <td>Program Studi: {{ !empty($study_program) ? $study_program : "All UKDW" }}</td>
    <td style="width:300px"></td>
    <td>Kategori: {{ !empty($category) ? $category : "-" }}</td>
  </tr>
  <tr>
    <td>Angkatan: {{ !empty($semester) ? $semester : "-" }}</td>
    <td style="width:300px"></td>
    <td>Tingkat: {{ !empty($activity_level) ? $activity_level : "-" }}</td>
  </tr>
  <tr>
    <td>Tahun: {{ !empty($date) ? $date : "-" }}</td>
    <td style="width:300px"></td>
  </tr>
</thead>
</table>
<br>
<table class="main-content" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th style="width:200px">Nama Mahasiswa</th>
            <th>Nama Kompetisi</th>
            <th>Waktu</th>
            <th>Capaian Peserta</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($competitions as $competition)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $competition->nim }}</td>
            <td>{{ $competition->name }}</td>
            <td>{{ $competition->activity_name }}</td>
            <td>{{ $competition->end_date }}</td>
            <td>{{ $competition->achievement }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="footer">
    <span>Yogyakarta, {{ \Carbon\Carbon::today()->format('d-m-Y') }}</span></br></br></br>
    <span>Biro 3 Kemahasiswaan, Alumni dan Pengembangan Karir</span></br>
    <span>Universitas Kristen Duta Wacana</span>
</div>