@extends('apoteker.layout')

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

        <h5 class="card-title fw-bolder mb-3">Ubah Data Apoteker</h5>

		<form method="post" action="{{ route('apoteker.update', $data->id_apoteker) }}">
			@csrf
            <div class="mb-3">
                <label for="id_apoteker" class="form-label">ID Apoteker</label>
                <input type="text" class="form-control" id="id_apoteker" name="id_apoteker" value="{{ $data->id_apoteker }}">
            </div>
            <div class="mb-3">
                <label for="nama_apoteker" class="form-label">Nama Apoteker</label>
                <input type="text" class="form-control" id="nama_apoteker" name="nama_apoteker" value="{{ $data->nama_apoteker }}">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $data->username }}">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="text" class="form-control" id="pass" name="pass" value="{{ $data->pass }}">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Edit" />
            </div>
			</div>
		</form>
	</div>
</div>

@stop