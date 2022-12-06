@extends('rekam_medis.layout')

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

		<form method="post" action="{{ route('rekam_medis.update', $data->id_rm) }}">
			@csrf
            <div class="mb-3">
                <label for="id_rm" class="form-label">ID Rekam Medis</label>
                <input type="text" class="form-control" id="id_rm" name="id_rm" value="{{ $data->id_rm }}">
            </div>
            <div class="mb-3">
                <label for="id_pasien" class="form-label">ID Pasien</label>
                <input type="text" class="form-control" id="id_pasien" name="id_pasien" value="{{ $data->id_pasien }}">
            </div>
            <div class="mb-3">
                <label for="id_apoteker" class="form-label">ID Apoteker</label>
                <input type="text" class="form-control" id="id_apoteker" name="id_apoteker" value="{{ $data->id_apoteker }}">
            </div>
            <div class="mb-3">
                <label for="id_dokter" class="form-label">ID Dokter</label>
                <input type="text" class="form-control" id="id_dokter" name="id_dokter" value="{{ $data->id_dokter }}">
            </div>
            <div class="mb-3">
                <label for="keluhan" class="form-label">Keluhan</label>
                <input type="text" class="form-control" id="keluhan" name="keluhan" value="{{ $data->keluhan }}">
            </div><div class="mb-3">
                <label for="diagnosa" class="form-label">Diagnosa</label>
                <input type="text" class="form-control" id="diagnosa" name="diagnosa" value="{{ $data->diagnosa }}">
            </div>
            </div><div class="mb-3">
                <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
                <input type="date" class="form-control" id="tgl_periksa" name="tgl_periksa" value="{{ $data->tgl_periksa }}">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Edit" />
            </div>
			</div>
		</form>
	</div>
</div>

@stop