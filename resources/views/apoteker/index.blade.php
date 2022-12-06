@extends('apoteker.layout')
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
            <a class="btn btn-outline-primary btn-sm" href="{{ route('apoteker.index') }}" type="button">Data Apoteker</a>
            <a class="btn btn-outline-dark btn-sm" href="{{ route('apoteker.trash') }}" type="button">Trash</a>
        </div>
    </div>
</div>
<h4 class="mt-5">Data Apoteker</h4>
<div class="form-search" style="float:right">
    <form action="{{ route('apoteker.search') }}" method="get" accept-charset="utf-8">
        <div class="form-group" style="display:flex">
            <input type="search" id="nama" name="nama" class="form-control" placeholder="Cari Nama Apoteker">
            <button type="submit" class="btn btn-secondary">Search</button>
    </form>
</div>
</div>
<a href="{{ route('apoteker.create') }}" type="button" class="btn btn-success rounded-3">Tambah Apoteker</a>
@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif
<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>ID Apoteker</th>
            <th>Nama Apoteker</th>
            <th>Username</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->id_apoteker }}</td>
            <td>{{ $data->nama_apoteker }}</td>
            <td>{{ $data->username }}</td>
            <td>
                <a href="{{ route('apoteker.edit', $data->id_apoteker) }}" type="button"
                    class="btn btn-warning rounded-3">Ubah</a>
                <!-- TAMBAHKAN KODE DELETE DIBAWAH BARIS INI -->
                <a href="{{ route('apoteker.hide', $data->id_apoteker) }}" type="button"
                    class="btn btn-danger rounded-3">Hapus</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop