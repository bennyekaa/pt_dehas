@extends('layouts.app')

<!DOCTYPE html>
<html>

<head>
<<<<<<< HEAD
	<title>PT DEHAS - Waduk</title>
=======
    <title>PT Dehas Inframedia Karsa - User</title>
>>>>>>> e362a111a1cee91d840f7aa543303b9b6403e499
</head>

<body>

<<<<<<< HEAD
	@section('content')

	<div class="container-fluid" id="container-wrapper">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Data Waduk</h1>
		</div>

		<div class="col-lg-12">
			<div class="card mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<a class="btn btn-primary" href="/waduk/tambah" style="float: left;"> + Tambah Data Waduk</a>
				</div>
				<div class="table-responsive p-3">
					<table class="table align-items-center table-flush" id="dataTable">
						<thead class="thead-light">
							<tr>
								<th>Batas Atas Muka Air</th>
								<th>Batas Bawah Muka Air</th>
								<th>Muka Air</th>
								<th>Tinggi Air</th>
								<th>Debit Keluar</th>
								<th>Status</th>
								<th>Keterangan</th>
								<th>Dibuat Pada</th>
								<th>Dibuat Oleh</th>
								<th>Diupdate Pada</th>
								<th>Diupdate Oleh</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody class="thead-light">
							@foreach($waduk as $p)
							<tr>
								<td>{{ $p->batas_atas_muka_air }} </td>
								<td>{{ $p->batas_bawah_muka_air }} </td>
								<td>{{ $p->muka_air }} </td>
								<td>{{ $p->tinggi_air }} </td>
								<td>{{ $p->debit_keluar }} </td>
								<td>{{ $p->status }} </td>
								<td>{{ $p->keterangan }} </td>
								<td>{{ $p->created_at }}</td>
								<td>{{ $p->created_by }}</td>
								<td>{{ $p->updated_at }}</td>
								<td>{{ $p->updated_by }}</td>
								<td>
									<div class="btn-group">
										<a class="btn btn-warning" title="Edit" href="/waduk/edit/{{ encrypt($p->id_waduk) }}">
											<i class="fa fa-edit"></i>
										</a>
										<a class="btn btn-danger" title="Hapus" href="/waduk/hapus/{{ $p->id_waduk }}">
											<i class="fa fa-trash"></i>
										</a>
							</tr>
							</td>
						</tbody>
						
						@endforeach
						@if(session('success'))
    				<div class="alert alert-success">
        				{{ session('success') }}
    				</div>
						@endif
						
					</table>
				</div>

			</div>
		</div>
		@endsection
=======
    @section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Status Waduk</h1>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a class="btn btn-primary" href="/waduk/tambah" style="float: left;"> + Tambah Status Waduk</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Muka Air Waduk</th>
                                <th>Tinggi Air diatas Ambang Pelimpah</th>
                                <th>Debit Keluar Pelimpah</th>
                                <th>Status Kondisi</th>
                                <th>Keterangan</th>
                                <th>Dibuat Pada</th>
                                <th>Dibuat Oleh</th>
                                <th>Diupdate Pada</th>
                                <th>Diupdate Oleh</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach($waduk as $p)
                        <thead class="thead-light">
                            <tr>
                                <td>{{ $p->muka_air }} </td>
                                <td>{{ $p->tinggi_air }} </td>
                                <td>{{ $p->debit_keluar }} </td>
                              

                                @if($p->status == 0) <td>
                                    <div class="alert alert-light" status="alert"> NORMAL</div>
                                </td>
                                @elseif($p->status == 1) <td>
                                    <div class="alert alert-primary" status="alert" style="font-color:white;"> WASPADA 1 RTD BENDUNGAN TAMBLANG </div>
                                </td>
                                @elseif($p->status == 2) <td>
                                    <div class="alert alert-success" status="alert"> BENDUNGAN TAMBLANG ATAU = BAHAYA BANJIR HIJAU DI HILIR BENDUNGAN</div>
                                </td>
                                @elseif($p->status == 3) <td>
                                    <div class="alert alert-warning" status="alert"> BENDUNGAN TAMBLANG ATAU = BAHAYA BANJIR KUNING DI HILIR BENDUNGAN</div>
                                </td>
                                @else <td>
                                    <div class="alert alert-danger" status="alert"> AWAS RTD ATAU = BAHAYA BANJIR MERAH DI HILIR BENDUNGAN</div>
                                </td>
                                @endif

                                <td>{{ $p->keterangan }} </td>
                                <td>{{ $p->created_at }}</td>
                                <td>{{ $p->created_by }}</td>
                                <td>{{ $p->updated_at }}</td>
                                <td>{{ $p->updated_by }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-warning" title="Edit" href="/waduk/edit/{{ encrypt($p->id_waduk) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger" title="Hapus" href="/waduk/hapus/{{ $p->id_waduk }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
    @endsection
>>>>>>> e362a111a1cee91d840f7aa543303b9b6403e499


</body>

</html>