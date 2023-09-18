@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Banjir</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    @if (session('nama_role') == 'OPERATOR')
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
                                    <th>Dibuat Pada</th>
                                    <th>Muka Air</th>
                                    {{-- <th>Tinggi Air</th> --}}
                                    <th>Debit Keluar</th>
                                    <th>Status Bendungan</th>
                                    {{-- @if (session('nama_role') == 'BALAI' || session('nama_role') == 'BPBD')
                                        <th>Kondisi Peta</th>
                                    @endif --}}
                                    {{-- <th>Dibuat Oleh</th>
                                    <th>Diupdate Pada</th>
                                    <th>Diupdate Oleh</th> --}}
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
                                        <td>{{ $item->created_at }}</td>
                                        {{-- <td>{{ $item->muka_air }} </td> --}}
                                        <td>{{ $item->tinggi_air }} </td>
                                        <td>{{ $item->debit_air }} </td>
                                        @if ($item->status == 0)
                                            <td>
                                                <div class="alert alert-info" status="alert"> NORMAL</div>
                                            </td>
                                        @elseif ($item->status == 1)
                                            <td>
                                                <div class="alert alert-primary" status="alert"
                                                    style="font-color:white; background-color: #66FF66;">
                                                    WASPADA 1</div>
                                            </td>
                                        @elseif ($item->status == 2)
                                            <td>
                                                <div class="alert alert-success" status="alert"> WASPADA 2</div>
                                            </td>
                                        @elseif ($item->status == 3)
                                            <td>
                                                <div class="alert alert-warning" status="alert"> SIAGA</div>
                                            </td>
                                        @elseif ($item->status == 4)
                                            <td>
                                                <div class="alert alert-danger" status="alert"> AWAS</div>
                                            </td>
                                        @else
                                            <td>
                                                <div class="alert alert-danger" status="alert"> BAHAYA</div>
                                            </td>
                                        @endif
                                        {{-- @if (session('nama_role') == 'BALAI' || session('nama_role') == 'BPBD')
                                            <td>{{ $item->peta->nama_peta }} </td>
                                        @endif --}}
                                        {{-- <td>{{ $item->created_by }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>{{ $item->updated_by }}</td> --}}
                                        <td>
                                            <div class="btn-group">
                                                @if (session('nama_role') == 'OPERATOR')
                                                    <a class="btn btn-primary" title="Kirim Ke Balai"
                                                        href="{{ url('transaksi/mukaair/kirim') }}/{{ encrypt($item->id_banjir_muka_air) }}/BALAI">
                                                        <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                    <a class="btn btn-danger alert_notif" id="notif" title="Hapus"
                                                        href="{{ url('transaksi/mukaair/hapus') }}/{{ encrypt($item->id_banjir_muka_air) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @elseif (session('nama_role') == 'BALAI')
                                                    @if (session('menu') == 1)
                                                        <div class="dropdown">
                                                            <a class="btn btn-primary dropdown-toggle"
                                                                title="Pilih Peta Kondisi" href="#" role="button"
                                                                id="dropdownMenuLink" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"> Pilih Peta
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                @foreach ($peta as $map)
                                                                    <a class="btn btn-dark" title="Lihat Peta"
                                                                        href="{{ url('peta/lihat') }}/{{ encrypt($map->id_peta) }}"
                                                                        target="_blank">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('peta/status') }}/{{ encrypt($map->id_peta) }}/{{ encrypt($item->id_banjir_muka_air) }}"
                                                                        title="{{ $map->nama_peta }}">
                                                                        {{ $map->nama_peta }}
                                                                    </a>
                                                                    {{-- <a class="dropdown-item"
                                                                    href="{{ url('peta/status') }}/{{ encrypt($map->id_peta) }}/{{ encrypt($item->id_banjir_muka_air) }}/1"
                                                                    title="{{ $map->nama_peta }}">{{ $map->nama_peta }}</a> --}}
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        @if (!empty($item->id_peta))
                                                            <a class="btn btn-primary" title="Kirim Ke BPBD"
                                                                href="{{ url('transaksi/mukaair/kirim') }}/{{ encrypt($item->id_banjir_muka_air) }}/BPBD">
                                                                <i class="fa fa-arrow-right"></i>
                                                            </a>
                                                        @endif
                                                        {{-- <a class="btn btn-danger alert_notif" id="notif" title="Hapus"
                                                    href="{{ url('transaksi/mukaair/hapus') }}/{{ encrypt($item->id_banjir_muka_air) }}">
                                                    <i class="fa fa-trash"></i>
                                                </a> --}}
                                                    @else
                                                        <div class="alert alert-danger" status="alert">Tidak Memiliki Akses
                                                        </div>
                                                    @endif
                                                @elseif(session('nama_role') == 'BPBD')
                                                    @if (session('menu') == 1)
                                                        <div class="dropdown">
                                                            <a class="btn btn-primary"
                                                                title="Kirim Pemberitahuan Ke Penduduk"
                                                                href="{{ url('transaksi/mukaair/kirim') }}/{{ encrypt($item->id_banjir_muka_air) }}/PENDUDUK">
                                                                <i class="fa fa-arrow-right"></i>
                                                            </a>
                                                            {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item"
                                                                href="{{ url('transaksi/mukaair/pesan') }}/{{ encrypt($item->id_banjir_muka_air) }}/2"
                                                                title="Kirim Ke Bupati">Bupati</a>
                                                            <a class="dropdown-item"
                                                                href="{{ url('transaksi/mukaair/pesan') }}/{{ encrypt($item->id_banjir_muka_air) }}/3">BPPD</a>
                                                            <a class="dropdown-item"
                                                                href="{{ url('transaksi/mukaair/pesan') }}/{{ encrypt($item->id_banjir_muka_air) }}/4">PENDUDUK</a>
                                                        </div> --}}
                                                        </div>
                                                    @else
                                                        <div class="alert alert-danger" status="alert">Tidak Memiliki Akses
                                                        </div>
                                                    @endif
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
