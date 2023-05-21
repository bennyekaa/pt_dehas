@extends('layouts.app')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Bocor</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                @if (session('role') == 0)
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a class="btn btn-primary" href="{{ url('transaksi/bocor/tambah') }}" style="float: left;"> +
                        Input Data Waduk Bocor
                    </a>
                </div>
                @endif
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Kategori</th>
                                <th>Status Bocor</th>
                                <th>keterangan</th>
                                <th>File</th>
                                <th>Dibuat Pada</th>
                                <th>Dibuat Oleh</th>
                                <th>Diupdate Pada</th>
                                <th>Diupdate Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            $file = 1;
                            @endphp
                            @foreach ($bocor as $item)
                            <tr>
                                <td>{{ $i++ }} </td>
                                <td>{{ $item->statusbocor->kategoribocor->nama_kategori}} </td>
                                <td>{{ $item->statusbocor->nama_status}} </td>
                                <td>{{ $item->keterangan}} </td>
                                <td>file-upload {{$file++}} </td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->created_by }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>{{ $item->updated_by }}</td>
                                <td>
                                    <div class="btn-group">
                                        @if (session('role') == 0)
                                        <a class="btn btn-primary" title="Kirim Ke Balai" href="{{ url('transaksi/bocor/kirim') }}/{{ encrypt($item->id_banjir_bocor) }}">
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                        <a class="btn btn-danger alert_notif" id="notif" title="Hapus" href="{{ url('transaksi/bocor/hapus') }}/{{ encrypt($item->id_banjir_bocor) }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        @elseif(session('role') == 5)
                                        <div class="dropdown">
                                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Kirim Pemberitahuan
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="{{url('transaksi/bocor/pesan')}}/{{encrypt($item->id_banjir_bocor)}}/2" title="Kirim Ke Bupati">Bupati</a>
                                                <a class="dropdown-item" href="{{url('transaksi/bocor/pesan')}}/{{encrypt($item->id_banjir_bocor)}}/3">BPPD</a>
                                                <a class="dropdown-item" href="{{url('transaksi/bocor/pesan')}}/{{encrypt($item->id_banjir_bocor)}}/4">PENDUDUK</a>
                                            </div>
                                        </div>
                                        @endif
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