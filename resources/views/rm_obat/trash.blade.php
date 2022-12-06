@extends('rm_obat.layout')
@section('content')
<a href="{{ route('home.index') }}" type="button" class="btn btn rounded-3">Laporan Rekam Medis</a>
<a href="{{ route('pasien.index') }}" type="button" class="btn btn rounded-3">Data Pasien</a>
<a href="{{ route('dokter.index') }}" type="button" class="btn btn rounded-3">Data Dokter</a>
<a href="{{ route('apoteker.index') }}" type="button" class="btn btn rounded-3">Data Apoteker</a>
<a href="{{ route('rm_obat.index') }}" type="button" class="btn btn rounded-3">Rekam Medis Obat</a>
<a href="{{ route('rekam_medis.index') }}" type="button" class="btn btn rounded-3">Rekam Medis</a>
<a href="{{ route('home.index') }}" type="button" class="btn btn-danger rounded-3" style="float:right">Log Out</a>
<div style="margin-top: 20px">
    <div style="margin-bottom: +45px">
        <div style="float:right">
            <a class="btn btn-outline-primary btn-sm" href="{{ route('rm_obat.index') }}" type="button">Data Apoteker</a>
            <a class="btn btn-outline-dark btn-sm" href="{{ route('rm_obat.trash') }}" type="button">Trash</a>
        </div>
    </div>
</div>
<h4 class="mt-5">Data Trash Apoteker</h4>
<div class="form-search" style="float:right">
    <form action="{{ route('rm_obat.search_trash') }}" method="get" accept-charset="utf-8">
        <div class="form-group" style="display:flex">
            <input type="text" id="nama_obat" name="nama_obat" class="form-control" placeholder="Nama obat">
            <button type="submit" class="btn btn-secondary">Search</button>
        </div>
    </form>
</div>
@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif
<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>ID obat</th>
            <th>Nama obat</th>
            <th>Jumlah Obat</th>
            <th>Harga Obat</th>
            <th>Dihapus Pada</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->id_obat }}</td>
            <td>{{ $data->nama_obat }}</td>
            <td>{{ $data->jmlh_obat}}</td>
            <td>{{ $data->harga}}</td>
            <td>{{ $data->deleted_at }}</td>
            <td>
                <a href="{{ route('rm_obat.restore', $data->id_obat) }}" type="button"
                    class="btn btn-success rounded-3">Restore</a>
                <!-- TAMBAHKAN KODE DELETE DIBAWAH BARIS INI -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                    data-bs-target="#hapusModal{{ $data->id_obat }}">
                    Hapus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hapusModal{{ $data->id_obat }}" tabindex="-1"
                    aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('rm_obat.delete', $data->id_obat) }}">
                                @csrf
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus data ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop