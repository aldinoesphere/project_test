@extends('layout/main');

@section('title', 'Data Karyawan')

@section('container')
<div class="container-fluid">
	<div class="row justify-content-md-center">
		<div class="col-8">
			<table class="table">
				<thead class="table-dark">
					<tr>
						<th>No</th>
						<th>Nama Karyawan</th>
						<th>Jenis Kelamin</th>
						<th>Nomor HP</th>
						<th>Email Aktif</th>
						<th>Current Salary</th>
						<th>Foto Profil</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($employees as $employee)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $employee->full_name }}</td>
						<td>
							@if($employee->gender == 1)
							{{ 'Laki-Laki' }}
							@else
							{{ 'Perempuan' }}
							@endif
						</td>
						<td>{{ $employee->phone }}</td>
						<td>{{ $employee->email }}</td>
						<td>{{ $employee->current_salary }}</td>
						<td><img width="50px" src="{{ url('photo_profile/'.$employee->photo_profile) }}"></td>
						<td>
							<a href="{{ url('/karyawan/'.$employee->id.'/edit') }}" class="btn btn-primary">Ubah</a>
							<form action="{{ url('/karyawan/'.$employee->id) }}" method="POST" class="d-inline">
								{{ method_field('DELETE') }}
								{{ csrf_field() }}
								<button class="btn btn-danger">Hapus</button>
							</form>
							<a href="{{ url('/karyawan/details/'.$employee->id) }}" class="btn btn-success">Detail</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>	
		</div>
	</div>
</div>
@endsection