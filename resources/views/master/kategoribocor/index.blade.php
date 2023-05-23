@extends('layouts.app')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kategori Bocor</h1>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <a class="btn btn-primary" href="{{ url('kategoribocor/tambah') }}" style="float: left;"> + Tambah 
                            Kategori</a>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kategori</th>
                                    <th>Dibuat Pada</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Diupdate Pada</th>
                                    <th>Diupdate Oleh</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($kategori as $item)
                                    <tr>
                                        <td>{{ $i++ }} </td>
                                        <td>{{ $item->nama_kategori }} </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->created_by }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>{{ $item->updated_by }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-warning" title="Edit"
                                                    href="{{ url('kategoribocor/edit') }}/{{ encrypt($item->id_kategori_bocor) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-danger alert_notif" id="notif" title="Hapus"
                                                    href="{{ url('kategoribocor/hapus') }}/{{ encrypt($item->id_kategori_bocor) }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
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
