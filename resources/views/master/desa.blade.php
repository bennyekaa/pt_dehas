@extends('layouts.app')

<!DOCTYPE html>
<html>

<head>
	<title>PT DEHAS - Desa</title>
</head>

<body>

	@section('content')

	<div class="container-fluid" id="container-wrapper">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Data Desa</h1>
		</div>

		<div class="col-lg-12">
			<div class="card mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<div class="table-responsive p-3">
						<div> <a class="btn btn-primary" href="/desa/tambah" style="float: left;"> + Tambah Desa Baru</a> </div>
						<table class="table align-items-center table-flush" id="dataTable">
							<thead class="thead-light">
								<tr>
									<th>Kode Pengungsian</th>
									<th>Desa</th>
									<th>Titik Kumpul</th>
									<th>Jarak Titik Kumpul</th>
									<th>TK X</th>
									<th>TK Y</th>
									<th>Lokasi Pengungsian</th>
									<th>Jarak Pengungsian</th>
									<th>P X</th>
									<th>P Y</th>
									<th>E X</th>
									<th>E Y</th>
									<th>Dibuat Pada</th>
									<th>Dibuat Oleh</th>
									<th>Diupdate Pada</th>
									<th>Diupdate Oleh</th>
									<th>Action</th>
								</tr>
							</thead>
							@foreach($desa as $p)
							<thead class="thead-light">
								<tr>

									<td>{{ $p->kode_pengungsian }} </td>
									<td>{{ $p->desa }} </td>
									<td>{{ $p->titik_kumpul }} </td>
									<td>{{ $p->jarak_titik_kumpul }} </td>
									<td>{{ $p->tk_x }} </td>
									<td>{{ $p->tk_y }} </td>
									<td>{{ $p->lokasi_pengungsian }} </td>
									<td>{{ $p->jarak_pengungsian }} </td>
									<td>{{ $p->p_x }} </td>
									<td>{{ $p->p_y }} </td>
									<td>{{ $p->e_x }} </td>
									<td>{{ $p->e_y }} </td>
									<td>{{ $p->created_at }}</td>
									<td>{{ $p->created_by }}</td>
									<td>{{ $p->updated_at }}</td>
									<td>{{ $p->updated_by }}</td>
									<th>Action</th>
								</tr>
							</thead>
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
		@endsection


</body>

</html>