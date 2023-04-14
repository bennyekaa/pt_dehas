@extends('layouts.app')

<!DOCTYPE html>
<html>

<head>
	<title>PT Dehas Inframedia Karsa - Desa</title>
</head>

<body>

	@section('content')

	@if ($errors->has('file'))
	<span class="invalid-feedback" role="alert">
		<strong>{{ $errors->first('file') }}</strong>
	</span>
	@endif

	@if ($sukses = Session::get('sukses'))
	<div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $sukses }}</strong>
	</div>
	@endif

	<!-- Import Excel -->
	<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form method="post" action="/desa/import_excel" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
					</div>
					<div class="modal-body">

						{{ csrf_field() }}

						<label>Pilih file excel</label>
						<div class="form-group">
							<input type="file" name="file" required="required">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Import</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="container-fluid" id="container-wrapper">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Data Desa</h1>
		</div>

		<div class="col-lg-12">
			<div class="card mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<a class="btn btn-primary" href="/desa/tambah" style="float: left;"> + Tambah Desa Baru</a>

				</div>
				<div class="card-header">
					<a href="/desa/export_excel" class="btn btn-success my-3" data-target="#importExcel">EXPORT EXCEL</a>
					<button type=" button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
						IMPORT EXCEL
						</button>
				</div>

				<div class="table-responsive p-3">
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
						<tbody class="thead-light">
							@foreach($desa as $p)
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
								<td>
									<div class="btn-group">
										<a class="btn btn-warning" title="Edit" href="/desa/edit/{{ encrypt($p->id_desa) }}">
											<i class="fa fa-edit"></i>
										</a>
										<a class="btn btn-danger" title="Hapus" href="/desa/hapus/{{ $p->id_desa }}">
											<i class="fa fa-trash"></i>
										</a>
							</tr>
							</td>
						</tbody>
						@endforeach
					</table>
				</div>

			</div>
		</div>
		@endsection
</body>

</html>