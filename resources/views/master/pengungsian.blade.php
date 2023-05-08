@extends('layouts.app')

<!DOCTYPE html>
<html>

<head>
    <title>PT Dehas Inframedia Karsa - User</title>
</head>

<body>

    @section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Pengungsian</h1>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a class="btn btn-primary" href="/pengungsian/tambah" style="float: left;"> + Tambah Pengungsian</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode Pengungsian</th>
                                <th>Pengungsian Latitude</th>
                                <th>Pengungsian Longitude</th>
                                <th>Nama Pengungsian</th>
                                <th>Nama Desa Pengungsian</th>
                                <th>Nama Kecamatan Pengungsian</th>
                                <th>Nama Kabupaten Pengungsian</th>
                                <th>Jarak ke Pengungsian</th>
                                <th>Dibuat Pada</th>
                                <th>Dibuat Oleh</th>
                                <th>Diupdate Pada</th>
                                <th>Diupdate Oleh</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach($pengungsian as $p)
                        <thead class="thead-light">
                            <tr>

                                <td>{{ $p->kode_pengungsian }} </td>
                                <td>{{ $p->pengungsian_lat }} </td>
                                <td>{{ $p->pengungsian_long }} </td>
                                <td>{{ $p->nama_pengungsian }} </td>
                                <td>{{ $p->nama_desa_pengungsian }} </td>
                                <td>{{ $p->nama_kecamatan_pengungsian }} </td>
                                <td>{{ $p->nama_kabupaten_pengungsian }} </td>
                                <td>{{ $p->jarak_pengungsian }} </td>
                                <td>{{ $p->created_at }}</td>
                                <td>{{ $p->created_by }}</td>
                                <td>{{ $p->updated_at }}</td>
                                <td>{{ $p->updated_by }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-warning" title="Edit" href="/pengungsian/edit/{{ encrypt($p->id_pengungsian) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger" title="Hapus" href="/pengungsian/hapus/{{ $p->id_pengungsian }}">
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


</body>

</html>