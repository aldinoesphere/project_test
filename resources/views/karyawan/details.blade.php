@extends('layout/main');

@section('title', 'Detail Data Karyawan')

@section('container')
<div class="container-fluid">
	<div class="row justify-content-md-center">
		<div class="col-8">
			<table class="table">
				<thead class="table-dark">
					<tr>
						<th>Field</th>
						<th>Value</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Nama</td>
						<td>{{ $employee->full_name }}</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>
							@if($employee->gender == 1)
							{{ 'Laki-Laki' }}
							@else
							{{ 'Perempuan' }}
							@endif
						</td>
					</tr>
					<tr>
						<td>Nomor HP</td>
						<td>{{ $employee->phone }}</td>
					</tr>
					<tr>
						<td>Email Aktif</td>
						<td>{{ $employee->email }}</td>
					</tr>
					<tr>
						<td>Current Salary</td>
						<td>{{ $employee->current_salary }}</td>
					</tr>
					<tr>
						<td>Foto Profil</td>
						<td>
							<img width="50px" src="{{ url('/photo_profile/'.$employee->photo_profile) }}">
						</td>
					</tr>
				</tbody>
			</table>
			<a href="{{ url('/karyawan/word-export/'.$employee->id) }}" class="btn btn-success">Export ke Word</a>
		</div>
	</div>
</div>
@endsection