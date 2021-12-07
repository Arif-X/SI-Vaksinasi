@extends('layouts.user')

@section('content')

<div class="mt-5">
	<h1>Profil</h1>
</div>
<div class="card">
	<div class="card-header text-white bg-primary">
		Profil	
	</div>
	<div class="card-body">
		@foreach($datas as $data)
		<form>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>NIK</label>
						<input type="text" name="nik" id="nik" class="form-control" required readonly value="{{ $data->nik }}" />
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" id="email" class="form-control" required readonly value="{{ $data->email }}" />
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input type="text" name="nama" id="nama" class="form-control" required readonly value="{{ $data->nama }}"  />
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" name="alamat" id="alamat" class="form-control" required readonly value="{{ $data->alamat }}" />
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Tanggal Lahir</label>
						<input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required readonly value="{{ $data->tanggal_lahir }}" />
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label>Status User</label>
						<input type="text" name="status" id="status" class="form-control" required readonly  value="{{ $data->nama_role }}" />
					</div>
				</div>
			</div>
		</form>
		@endforeach
	</div>
</div>

@endsection