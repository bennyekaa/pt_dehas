@extends('layouts.app')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Peta</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Peta Banjir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($peta as $item)
                                    <tr>
                                        <td>{{ $i++ }} </td>
                                        <td>{{ $item->nama_peta }} </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-dark" title="Lihat Peta"
                                                    href="{{ url('peta/lihat') }}/{{ encrypt($item->id_peta) }}" target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a class="btn btn-success" title="Aktifkan"
                                                    href="{{ url('peta/status') }}/{{ encrypt($item->id_peta) }}/1">
                                                    <i class="fa fa-check"></i>
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
