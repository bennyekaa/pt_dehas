@extends('layouts.app')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Titik Kumpul</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <!-- <a class="btn btn-primary" href="{{ url('titikkumpul/tambah') }}" style="float: left;"> + Tambah Titik Kumpul</a> -->
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Kode Titik Kumpul</th>
                                    <th>Titik Kumpul Latitude</th>
                                    <th>Titik Kumpul Longitude</th>
                                    <th>Nama Titik Kumpul</th>
                                    <th>Nama Desa</th>
                                    <th>Nama Kecamatan</th>
                                    <th>Nama Kabupaten</th>
                                    <th>Jarak ke Titik Kumpul</th>
                                    {{-- <th>Dibuat Pada</th>
                                <th>Dibuat Oleh</th>
                                <th>Diupdate Pada</th>
                                <th>Diupdate Oleh</th> --}}
                                    @if (session('role') == 'DEWA')
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($kumpul as $p)
                                    <tr>
                                        <td>{{ $p->kode_tk }} </td>
                                        <td>{{ $p->tk_lat }} </td>
                                        <td>{{ $p->tk_long }} </td>
                                        <td>{{ $p->nama_titik_kumpul }} </td>
                                        <td>{{ $p->nama_desa }} </td>
                                        <td>{{ $p->nama_kecamatan }} </td>
                                        <td>{{ $p->nama_kabupaten }} </td>
                                        <td>{{ $p->jarak_ke_tk }} KM</td>
                                        {{-- <td>{{ $p->created_at }}</td>
                                <td>{{ $p->created_by }}</td>
                                <td>{{ $p->updated_at }}</td>
                                <td>{{ $p->updated_by }}</td> --}}
                                        @if (session('nama_role') == 'DEWA')
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-warning" title="Edit"
                                                        href="/titikkumpul/edit/{{ encrypt($p->id_titik_kumpul) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger alert_notif" id="notif" title="Hapus"
                                                        href="{{ url('titikkumpul/hapus') }}/{{ encrypt($p->id_titik_kumpul) }}">
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
