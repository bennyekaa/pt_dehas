@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Banjir</h1>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a class="btn btn-primary" href="{{ url('transaksi/mukaair/tambah') }}" style="float: left;"> + Input Data
                        Waduk</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Muka Air</th>
                                <th>Dibuat Pada</th>
                                <th>Dibuat Oleh</th>
                                <th>Diupdate Pada</th>
                                <th>Diupdate Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($mukaair as $item)
                            <thead class="thead-light">
                                <tr>
                                    <td>{{ $i++ }} </td>
                                    <td>{{ $item->muka_air }} </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->created_by }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>{{ $item->updated_by }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-warning" title="Edit"
                                                href="{{ url('web/edit') }}/{{ encrypt($item->id_banjir_muka_air) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger" id="notif" title="Hapus"
                                                href="{{ url('web/hapus') }}/{{ encrypt($item->id_banjir_muka_air) }}">
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
