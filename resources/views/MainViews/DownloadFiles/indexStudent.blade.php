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
<h4 style="text-align:center;">CATATAN PRESTASI MAHASISWA<br>UNIVERSITAS KRISTEN DUTA WACANA <br>{{ !empty($date) ? "TAHUN " . $date : "" }}</h4>
<table class="content-header" cellspacing="0">
<thead>
    <tr>
        <td colspan=3>Kami yang bertanda tangan di bawah ini:</td>
    </tr>
    <br>
    <tr>
        <td>Nama</td>
        <td>: Biro 3 Kemahasiswaan, Alumni dan Pengembangan Karir</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>: Gedung Hagios lantai 1, UKDW</td>
    </tr>
    <tr>
        <td>Telepon</td>
        <td>: +62 813 3666 0839</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>: biro3@staff.ukdw.ac.id</td>
    </tr>
    <br>
    <tr>
        <td colspan=3>Dengan ini memberikan pengantar kepada yang terhormat Kepala Sekolah/Universitas/Institusi untuk memberikan catatan prestasi mahasiswa sebagai berikut:</td>
    </tr>
    <br>
    <tr>
        <td>Nama Mahasiswa</td>
        <td>: {{ $user->name }}</td>
    </tr>
    <tr>
        <td>NIM</td>
        <td>: {{ $user->nim }}</td>
    </tr>
    <tr>
        <td>Fakultas</td>
        <td>: {{ $user->faculty }}</td>
    </tr>
    <tr>
        <td>Program Studi</td>
        <td>: {{ $user->study_program }}</td>
    </tr>
</thead>
</table>
<br>
<table class="main-content" cellspacing="0">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col" width="200px">Nama Kompetisi</th>
            <th scope="col">Waktu</th>
            <th scope="col">Capaian Peserta</th>
            <th scope="col" width="150px">Kategori</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($competitions as $competition)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $competition->category->activity_name }}</td>
            <td>{{ $competition->start_date }}</td>
            <td>{{ $competition->achievement }}</td>
            <td>{{ $competition->category->category }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="footer">
    <span>Sleman, {{ \Carbon\Carbon::today()->format('d-m-Y') }}</span></br></br></br>
    <span>Biro 3 Kemahasiswaan, Alumni dan Pengembangan Karir</span></br>
    <span>Universitas Kristen Duta Wacana</span>
</div>