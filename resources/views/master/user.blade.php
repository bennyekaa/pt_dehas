@extends('layouts.app')

<!DOCTYPE html>
<html>

<head>
	<title>PT DEHAS - User</title>
</head>

<body>

	@section('content')

	<div class="container-fluid" id="container-wrapper">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Data User</h1>
		</div>

		<div class="col-lg-12">
			<div class="card mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<div class="table-responsive p-3">
						<table class="table align-items-center table-flush" id="dataTable">
							<thead class="thead-light">
								<tr>
									<th>Nama</th>
									<th>Email</th>
									<th>HP</th>
									<th>Username</th>
									<th>Role</th>
									<th>Dibuat Pada</th>
									<th>Dibuat Oleh</th>
									<th>Diupdate Pada</th>
									<th>Diupdate Oleh</th>
									<th>Action</th>
								</tr>
							</thead>
							@foreach($user as $p)
							<thead class="thead-light">
								<tr>

									<td>{{ $p->nama }} </td>
									<td>{{ $p->email }} </td>
									<td>{{ $p->hp }} </td>
									<td>{{ $p->username }} </td>
									@if($p->role == 0) <td>
										<div class="alert alert-secondary" role="alert"> Operator</div>
									</td>
									@elseif($p->role == 1) <td>
										<div class="alert alert-primary" role="alert" style="font-color:white;"> Admin</div>
									</td>
									@elseif($p->role == 2) <td>
										<div class="alert alert-info" role="alert"> Atasan</div>
									</td>
									@elseif($p->role == 3) <td>
										<div class="alert alert-success" role="alert"> BPPD</div>
									</td>
									@else <td>
										<div class="alert alert-dark" role="alert"> Umum</div>
									</td>
									@endif
									<td>{{ $p->created_at }}</td>
									<td>{{ $p->created_by }}</td>
									<td>{{ $p->updated_at }}</td>
									<td>{{ $p->updated_by }}</td>
									<td>
										<div class="btn-group">
											<a class="btn btn-warning" title="Edit" href="/user/edit/{{ encrypt($p->id_user) }}">
												<i class="fa fa-edit"></i>
											</a>
											<a class="btn btn-danger" title="Hapus" href="/user/hapus/{{ $p->id_user }}">
												<i class="fa fa-trash"></i>
											</a>
										</div>
									</td>
								</tr>
							</thead>
							@endforeach
						</table>
						<a class="btn btn-primary" href="/user/tambah" style="float: left;"> + Tambah User Baru</a>
					</div>
				</div>
			</div>
		</div>
		@endsection


</body>

</html>