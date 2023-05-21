@extends('layouts.app')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Banjir</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                @if (session('role') == 0)
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a class="btn btn-primary" href="{{ url('transaksi/mukaair/tambah') }}" style="float: left;"> +
                        Input
                        Data
                        Waduk</a>
                </div>
                @endif
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Muka Air</th>
                                <th>Tinggi Air</th>
                                <th>Debit Keluar</th>
                                <th>Status Bendungan</th>
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
                            @endphp
                            @foreach ($mukaair as $item)
                            <tr>
                                <td>{{ $i++ }} </td>
                                <td>{{ $item->waduk->muka_air }} </td>
                                <td>{{ $item->waduk->tinggi_air }} </td>
                                <td>{{ $item->waduk->debit_keluar }} </td>
                                @if ($item->waduk->status == 0)
                                <td>
                                    <div class="alert alert-success" status="alert"> NORMAL</div>
                                </td>
                                @elseif ($item->waduk->status == 1)
                                <td>
                                    <div class="alert alert-primary" status="alert" style="font-color:white;">
                                        WASPADA 1 RTD BENDUNGAN TAMBLANG </div>
                                </td>
                                @elseif ($item->waduk->status == 2)
                                <td>
                                    <div class="alert alert-secondary" status="alert"> BENDUNGAN TAMBLANG ATAU =
                                        BAHAYA BANJIR HIJAU DI HILIR BENDUNGAN</div>
                                </td>
                                @elseif ($item->waduk->status == 3)
                                <td>
                                    <div class="alert alert-info" status="alert"> BENDUNGAN TAMBLANG ATAU =
                                        BAHAYA BANJIR KUNING DI HILIR BENDUNGAN</div>
                                </td>
                                @elseif ($item->waduk->status == 4)
                                <td>
                                    <div class="alert alert-warning" status="alert"> AWAS RTD ATAU = BAHAYA
                                        BANJIR
                                        MERAH DI HILIR BENDUNGAN</div>
                                </td>
                                @else
                                <td>
                                    <div class="alert alert-danger" status="alert"> AWAS RTD ATAU = BAHAYA
                                        BANJIR
                                        MERAH DI HILIR BENDUNGAN</div>
                                </td>
                                @endif
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->created_by }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>{{ $item->updated_by }}</td>
                                <td>
                                    <div class="btn-group">
                                        @if (session('role') == 0)
                                        <a class="btn btn-primary" title="Kirim Ke Balai" href="{{ url('transaksi/mukaair/kirim') }}/{{ encrypt($item->id_banjir_muka_air) }}">
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                        <a class="btn btn-danger alert_notif" id="notif" title="Hapus" href="{{ url('transaksi/mukaair/hapus') }}/{{ encrypt($item->id_banjir_muka_air) }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        @elseif(session('role') == 5)
                                        <div class="dropdown">
                                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Kirim Pemberitahuan
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="{{url('transaksi/mukaair/pesan')}}/{{encrypt($item->id_banjir_muka_air)}}/2" title="Kirim Ke Bupati">Bupati</a>
                                                <a class="dropdown-item" href="{{url('transaksi/mukaair/pesan')}}/{{encrypt($item->id_banjir_muka_air)}}/3">BPPD</a>
                                                <a class="dropdown-item" href="{{url('transaksi/mukaair/pesan')}}/{{encrypt($item->id_banjir_muka_air)}}/4">PENDUDUK</a>
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