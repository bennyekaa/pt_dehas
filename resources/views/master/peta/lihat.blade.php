@extends('layouts.app')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Login Device</h1>
        </div>

        <div class="row">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a class="btn btn-warning" href="{{session('device') }}" style="float: left;"> < Kembali</a>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Role</th>
                                    <th>Mac Address</th>
                                    <th>Login With</th>
                                    <th>Status Aktif</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($login_device as $item)
                                    <tr>
                                        <td>{{ $i++ }} </td>
                                        <td>{{ $item->user->role->nama_role }}</td>
                                        <td>{{ empty($item->mac_add) ? 'Data Kosong' : $item->mac_add }} </td>
                                        <td>{{ empty($item->keterangan) ? 'Data Kosong' : $item->keterangan }} </td>
                                        @if ($item->aktif == 0)
                                            <td>
                                                <div class="alert alert-danger" style="font-color:white;">Tidak Aktif</div>
                                            </td>
                                        @else
                                            <td>
                                                <div class="alert alert-success" style="font-color:white;">Aktif</div>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-primary" title="Reset Device"
                                                    href="{{ url('device/reset') }}/{{ encrypt($item->id_log) }}">
                                                    <i class="fa fa-arrows-h"></i>
                                                </a>
                                                <a class="btn btn-info" title="Enable"
                                                    href="{{ url('device/status') }}/{{ encrypt($item->id_log) }}/1">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                                <a class="btn btn-secondary" title="Disable"
                                                    href="{{ url('device/status') }}/{{ encrypt($item->id_log) }}/0">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                                <a class="btn btn-danger" title="Hapus"
                                                    href="{{ url('device/hapus') }}/{{ encrypt($item->id_log) }}">
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
