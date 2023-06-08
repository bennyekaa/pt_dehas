@extends('layouts.app')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Device</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Total Device</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($device as $item)
                            <tr>
                                <td>{{ $i++ }} </td>
                                <td>{{ $item->username }} </td>
                                <td>{{ $item->email }} </td>
                                <td>{{ $item->role->nama_role }} </td>
                                <td>{{ $item->total_device }} </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-dark" title="Lihat Device Tersambung" href="{{ url('device/lihat') }}/{{ encrypt($item->id_user) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-primary" title="Tambah Device" href="{{ url('device/edit') }}/{{ encrypt($item->id_user) }}">
                                            <i class="fa fa-plus"></i>
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
