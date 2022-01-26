@extends('layout/main');

@section('title', 'Isi Data Karyawan')

@section('container')
<div class="container-fluid">
	<div class="row justify-content-md-center">
		<div class="col-8">
			<form method="POST" action="/karyawan" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="mb-3">
					<label for="nama" class="form-label">Nama</label>
					<input type="text" class="form-control" name="full_name" placeholder="Masukan Nama Lengkap">
				</div>
				<div class="mb-3">
					<label for="gender" class="form-label">Jenis Kelamin</label>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="gender" id="laki-laki" value="1">
						<label class="form-check-label" for="laki-laki">
							Laki-Laki
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="gender" id="perempuan" value="2">
						<label class="form-check-label" for="perempuan">
							Perempuan
						</label>
					</div>
				</div>
				<div class="mb-3">
					<label for="phone" class="form-label">No Telepon</label>
					<input type="text" class="form-control" name="phone" id="phone">
				</div>
				<div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
				</div>
				<div class="mb-3">
					<label for="current_salary" class="form-label">Current Salary</label>
					<input type="text" class="form-control" name="current_salary" id="current_salary">
				</div>
				<div class="input-group mb-3">
					<label class="input-group-text" for="photo_profile">Upload</label>
					<input type="file" class="form-control" name="photo_profile" id="photo_profile">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection