@extends('rm_obat.layout')
@section('content')
<a href="{{ route('home.index') }}" type="button" class="btn btn rounded-3">Laporan Rekam Medis</a>
<a href="{{ route('pasien.index') }}" type="button" class="btn btn rounded-3">Data Pasien</a>
<a href="{{ route('dokter.index') }}" type="button" class="btn btn rounded-3">Data Dokter</a>
<a href="{{ route('apoteker.index') }}" type="button" class="btn btn rounded-3">Data Apoteker</a>
<a href="{{ route('rm_obat.index') }}" type="button" class="btn btn rounded-3">Rekam Medis Obat</a>
<a href="{{ route('rekam_medis.index') }}" type="button" class="btn btn rounded-3">Rekam Medis</a>
<form action="logout" method="post">
    @csrf
    <button type="submit" class="btn btn-danger rounded-3" style="float:right">Logout</button>
</form>
<div style="margin-top: 20px">
    <div style="margin-bottom: +45px">
        <div style="float:right">
            <a class="btn btn-outline-primary btn-sm" href="{{ route('rm_obat.index') }}" type="button">Data Rekam Medis</a>
            <a class="btn btn-outline-dark btn-sm" href="{{ route('rm_obat.trash') }}" type="button">Trash</a>
        </div>
    </div>
</div>
<a href="{{ route('rm_obat.create') }}" type="button" class="btn btn-success rounded-3">Tambah Rekam Medis Obat</a>
<h4 class="mt-5">Data Rekam Medis Obat</h4>
<div class="form-search" style="float:right">
    <form action="{{ route('rm_obat.search') }}" method="get" accept-charset="utf-8">
        <div class="form-group" style="display:flex">
            <input type="search" id="nama" name="nama" class="form-control" placeholder="Cari Nama Obat">
            <button type="submit" class="btn btn-secondary">Search</button>
    </form>
</div></div>

@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif
<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>ID Obat</th>
            <th>Nama Obat</th>
            <th>Jumlah Obat</th>
            <th>Harga Obat</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->id_obat }}</td>
            <td>{{ $data->nama_obat }}</td>
            <td>{{ $data->jmlh_obat }}</td>
            <td>{{ $data->harga }}</td>
            <td>
                <a href="{{ route('rm_obat.edit', $data->id_obat) }}" type="button"
                    class="btn btn-warning rounded-3">Ubah</a>
                <!-- TAMBAHKAN KODE DELETE DIBAWAH BARIS INI -->
                <a href="{{ route('rm_obat.hide', $data->id_obat) }}" type="button"
                    class="btn btn-danger rounded-3">Hapus</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop