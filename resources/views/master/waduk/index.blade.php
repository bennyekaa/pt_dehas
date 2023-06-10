@extends('layouts.app')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Status Waduk</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        {{-- <a class="btn btn-primary" href="/waduk/tambah" style="float: left;"> + Tambah Status Waduk</a> --}}
                        <div class="btn-group">
                            <a href="/desa/export_excel" class="btn btn-success my-3" data-target="#importExcel">EXPORT
                                EXCEL</a>
                            <a href="{{url('waduk/import')}}" class="btn btn-primary my-3">IMPORT EXCEL</a>
                        </div>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Batas Bawah</th>
                                    <th>Batas Atas</th>
                                    <th>Puncak</th>
                                    <th>Ambang</th>
                                    <th>Lebar</th>
                                    <th>c</th>
                                    <th>Status Kondisi</th>
                                    <th>Keterangan</th>
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
                                @foreach ($waduk as $p)
                                    <tr>
                                        <td>{{ $i++ }} </td>
                                        <td>{{ $p->batas_bawah }} </td>
                                        <td>{{ $p->batas_atas }} </td>
                                        <td>{{ $p->puncak }} </td>
                                        <td>{{ $p->ambang }} </td>
                                        <td>{{ $p->lebar }} </td>
                                        <td>{{ $p->c }} </td>
                                        @if ($p->status == 0)
                                            <td>
                                                <div class="alert alert-info" status="alert">NORMAL</div>
                                            </td>
                                        @elseif($p->status == 1)
                                            <td>
                                                <div class="alert alert-primary" status="alert" style="font-color:white;">
                                                    WASPADA 1</div>
                                            </td>
                                        @elseif($p->status == 2)
                                            <td>
                                                <div class="alert alert-success" status="alert">WASPADA 2</div>
                                            </td>
                                        @elseif($p->status == 3)
                                            <td>
                                                <div class="alert alert-warning" status="alert">SIAGA</div>
                                            </td>
                                        @elseif ($p->status == 4)
                                            <td>
                                                <div class="alert alert-danger" status="alert">AWAS</div>
                                            </td>
                                        @else
                                            <td>
                                                <div class="alert alert-danger" status="alert">BAHAYA</div>
                                            </td>
                                        @endif
                                        <td>{{ $p->keterangan }} </td>
                                        <td>{{ $p->created_at }}</td>
                                        <td>{{ $p->created_by }}</td>
                                        <td>{{ $p->updated_at }}</td>
                                        <td>{{ $p->updated_by }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-warning" title="Edit"
                                                    href="{{ url('waduk/edit') }}/{{ encrypt($p->id_waduk) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-danger alert_notif" title="Hapus"
                                                    href="{{ url('waduk/hapus') }}/{{ encrypt($p->id_waduk) }}">
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
