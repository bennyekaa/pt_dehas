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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <!-- <a class="btn btn-primary" href="/pengungsian/tambah" style="float: left;"> + Tambah
                                        Pengungsian</a> -->
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
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
                                        {{-- <th>Dibuat Pada</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Diupdate Pada</th>
                                        <th>Diupdate Oleh</th> --}}
                                        @if (session('nama_role') == 'DEWA')
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($pengungsian as $p)
                                        <tr>
                                            <td>{{ $p->kode_pengungsian }} </td>
                                            <td>{{ $p->pengungsian_lat }} </td>
                                            <td>{{ $p->pengungsian_long }} </td>
                                            <td>{{ $p->nama_pengungsian }} </td>
                                            <td>{{ $p->nama_desa_pengungsian }} </td>
                                            <td>{{ $p->nama_kecamatan_pengungsian }} </td>
                                            <td>{{ $p->nama_kabupaten_pengungsian }} </td>
                                            <td>{{ $p->jarak_pengungsian }} KM</td>
                                            {{-- <td>{{ $p->created_at }}</td>
                                            <td>{{ $p->created_by }}</td>
                                            <td>{{ $p->updated_at }}</td>
                                            <td>{{ $p->updated_by }}</td> --}}
                                            @if (session('nama_role') == 'DEWA')
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-warning" title="Edit"
                                                            href="/pengungsian/edit/{{ encrypt($p->id_pengungsian) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a class="btn btn-danger alert_notif" title="Hapus"
                                                            href="/pengungsian/hapus/{{ encrypt($p->id_pengungsian) }}">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection


</body>

</html>
