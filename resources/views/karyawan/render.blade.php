<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Export to Word</title>
  </head>
  <body>
  	<div class="container-fluid">
	<div class="row justify-content-md-center">
		<div class="col-6">
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
		</div>
	</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>