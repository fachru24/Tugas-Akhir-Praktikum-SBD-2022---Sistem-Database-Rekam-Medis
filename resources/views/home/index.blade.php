@extends('home.layout')
@section('content')
<form action="logout" method="post">
    @csrf
    <button type="submit" class="btn btn-danger rounded-3" style="float:right">Logout</button>
</form>
<a href="{{ route('login.index') }}" type="button" class="btn btn rounded-3">Login</a>
<h4 class="mt-5">Data Rekam Medis</h4>
<form action="">
<div class="input-group mt-3 mb-2">
    <input name="search" type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="button-addon2">
    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
</div>
</form>
<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>ID Pasien</th>
            <th>Nama Pasien</th>
            <th>Alamat</th>
            <th>Keluhan</th>
            <th>Diagnosa</th>
            <th>Tanggal Periksa</th>
            <th>Dokter Pemeriksa</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->id_pasien }}</td>
            <td>{{ $data->nama_pasien }}</td>
            <td>{{ $data->alamat }}</td>
            <td>{{ $data->keluhan }}</td>
            <td>{{ $data->diagnosa }}</td>
            <td>{{ $data->tgl_periksa }}</td>
            <td>{{ $data->nama_dokter }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop