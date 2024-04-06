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
<h4 style="text-align:center;">PENGAJUAN KOMPETISI MAHASISWA<br>UNIVERSITAS KRISTEN DUTA WACANA <br>TAHUN {{ \Carbon\Carbon::today()->year }}</h4>
<table>
    <tr>
        <td>Nama</td>
        <td></td>
        <td>: {{ $competition->leader->name }}</td>
    </tr>
    <tr>
        <td>NIM</td>
        <td></td>
        <td>: {{ $competition->leader->nim }}</td>
    </tr>
    <tr>
        <td>Nama Kegiatan</td>
        <td></td>
        <td>: {{ $competition->category->activity_name }}</td>
    </tr>
    <tr>
        <td>Tingkat Kegiatan</td>
        <td></td>
        <td>: {{ $competition->category->activity_level }}</td>
    </tr>
    <tr>
        <td>Kategori</td>
        <td></td>
        <td>: {{ $competition->category->category }}</td>
    </tr>
    <tr>
        <td>Capaian Peserta</td>
        <td></td>
        <td>: {{ $competition->achievement }}</td>
    </tr>
    <tr>
        <td>Tahun Kegiatan</td>
        <td></td>
        <td>: {{ $competition->category->activity_year }}</td>
    </tr>
    <tr>
        <td>Jenis Kepesertaan</td>
        <td></td>
        <td>: {{ $competition->category->activity_type }}</td>
    </tr>
    <tr>
        <td>Tanggal Mulai</td>
        <td></td>
        <td>: {{ $competition->start_date }}</td>
    </tr>
    <tr>
        <td>Tanggal Selesai</td>
        <td></td>
        <td>: {{ $competition->end_date }}</td>
    </tr>
    <tr>
        <td>Jumlah Peserta</td>
        <td></td>
        <td>: {{ $competition->category->activity_type == "Individu" ? 1 : $competition->participant_number }}</td>
    </tr>
    <tr>
        <td>Nama Ketua Kelompok</td>
        <td></td>
        <td>: {{ $competition->leader->name }}</td>
    </tr>
    <tr>
        <td>NIM Ketua Kelompok</td>
        <td></td>
        <td>: {{ $competition->leader->nim }}</td>
    </tr>
    <tr>
        <td>Nama Anggota Kelompok</td>
        <td></td>
        <td>: {{ $competition->members == "" ? '-' : $competition->members }}</td>
    </tr>
    <tr>
        <td>NIM Anggota Kelompok</td>
        <td></td>
        <td>: {{ $competition->members_nim == "" ? '-' : $competition->members_nim }}</td>
    </tr>
    <tr>
        <td>Dosen Pembimbing</td>
        <td></td>
        <td>: {{ $competition->lecture->name }}</td>
    </tr>
    <tr>
        <td>NIK/NIDN/NIDN Dosen</td>
        <td></td>
        <td>: {{ $competition->lecture->nim }}</td>
    </tr>
    <tr>
        <td>Keterangan</td>
        <td></td>
        <td>: {{ $competition->description == "" ? "-" : $competition->description }}</td>
    </tr>
</table>