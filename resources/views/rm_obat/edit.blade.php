@extends('rm_obat.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Ubah Data Rekam Medis</h5>

		<form method="post" action="{{ route('rm_obat.update', $data->id_obat) }}">
			@csrf
            <div class="mb-3">
                <label for="id_obat" class="form-label">ID Obat</label>
                <input type="text" class="form-control" id="id_obat" name="id_obat" value="{{ $data->id_obat }}">
            </div>
            <div class="mb-3">
                <label for="nama_obat" class="form-label">Nama Obat</label>
                <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="{{ $data->nama_obat }}">
            </div>
            <div class="mb-3">
                <label for="jmlh_obat" class="form-label">Jumlah Obat</label>
                <input type="text" class="form-control" id="jmlh_obat" name="jmlh_obat" value="{{ $data->jmlh_obat }}">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" value="{{ $data->harga }}">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Edit" />
            </div>
			</div>
		</form>
	</div>
</div>

@stop