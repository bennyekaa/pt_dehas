@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Indikasi Masalah</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    @if (session('nama_role') == 'OPERATOR')
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <a class="btn btn-primary" href="{{ url('transaksi/bocor/tambah') }}" style="float: left;"> +
                                Input Data Indikasi
                            </a>
                        </div>
                    @endif
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Dibuat Pada</th>
                                    @if (session('nama_role') == 'BALAI' || session('nama_role') == 'BPBD')
                                        <th>Kondisi Peta</th>
                                        <th>Bendungan</th>
                                    @endif
                                    <th>Nama Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Elevasi Muka Air Waduk (Meter)</th>
                                    <th>Debit (m3/Detik)</th>
                                    {{-- <th>Ukuran (Meter)</th> --}}
                                    <th>Kekuatan (SR)</th>
                                    <th>Diameter (Meter)</th>
                                    <th>Tinggi (Meter)</th>
                                    <th>Panjang (Meter)</th>
                                    <th>Lebar (Meter)</th>
                                    <th>Keterangan</th>
                                    @if (session('nama_role') == 'BALAI')
                                        <th>Foto</th>
                                        <th>Foto</th>
                                        <th>Foto</th>
                                        <th>Foto</th>
                                        <th>Foto</th>
                                    @endif
                                    {{-- <th>Dibuat Oleh</th>
                                    <th>Diupdate Pada</th>
                                    <th>Diupdate Oleh</th>
                                    <th>Diupdate BPBD Pada</th>
                                    <th>Diupdate BPBD </th> --}}
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
                                        <td>{{ $item->bocor_created_at }}</td>
                                        @if (session('nama_role') == 'BALAI' || session('nama_role') == 'BPBD')
                                            <td>{{ $item->peta->nama_peta }} </td>
                                            @if ($item->nama_bendungan == 1)
                                                <td>BENDUNGAN GONGSENG</td>
                                            @else
                                                <td>BENDUNGAN PACAL</td>
                                            @endif
                                        @endif
                                        <td>{{ $item->nama_kategori }} </td>
                                        <td>{{ $item->lokasi }} </td>
                                        {{-- <td>{{ $item->ukuran }} </td> --}}
                                        <td>{{ $item->tinggi_air }} </td>
                                        <td>{{ $item->debit }} </td>
                                        <td>{{ $item->kekuatan }} </td>
                                        <td>{{ $item->diameter }} </td>
                                        <td>{{ $item->tinggi }} </td>
                                        <td>{{ $item->panjang }} </td>
                                        <td>{{ $item->lebar }} </td>
                                        <td>{{ $item->keterangan }} </td>
                                        {{-- <td>file-upload {{$file++}} </td> --}}
                                        @if (session('nama_role') == 'BALAI')
                                            @if (!empty($item->file_1))
                                                <td><a class="btn btn-warning" title="Lihat Bukti Dukung"
                                                        href="{{ url('transaksi/bocor/view_berkas') }}/{{ encrypt($item->id_banjir_bocor) }}"
                                                        target="_blank">
                                                        <i class="fa fa-eye"></i>
                                                    </a></td>
                                            @else
                                                <td></td>
                                            @endif
                                            @if (!empty($item->file_2))
                                                {{-- <td>file-upload {{$file++}} </td> --}}
                                                <td><a class="btn btn-warning" title="Lihat Bukti Dukung"
                                                        href="{{ url('transaksi/bocor/view_berkas2') }}/{{ encrypt($item->id_banjir_bocor) }}"
                                                        target="_blank">
                                                        <i class="fa fa-eye"></i>
                                                    </a></td>
                                                {{-- <td>file-upload {{$file++}} </td> --}}
                                            @else
                                                <td></td>
                                            @endif
                                            @if (!empty($item->file_3))
                                                <td><a class="btn btn-warning" title="Lihat Bukti Dukung"
                                                        href="{{ url('transaksi/bocor/view_berkas3') }}/{{ encrypt($item->id_banjir_bocor) }}"
                                                        target="_blank">
                                                        <i class="fa fa-eye"></i>
                                                    </a></td>
                                                {{-- <td>file-upload {{$file++}} </td> --}}
                                            @else
                                                <td></td>
                                            @endif
                                            @if (!empty($item->file_4))
                                                <td><a class="btn btn-warning" title="Lihat Bukti Dukung"
                                                        href="{{ url('transaksi/bocor/view_berkas4') }}/{{ encrypt($item->id_banjir_bocor) }}"
                                                        target="_blank">
                                                        <i class="fa fa-eye"></i>
                                                    </a></td>
                                                {{-- <td>file-upload {{$file++}} </td> --}}
                                            @else
                                                <td></td>
                                            @endif
                                            @if (!empty($item->file_5))
                                                <td><a class="btn btn-warning" title="Lihat Bukti Dukung"
                                                        href="{{ url('transaksi/bocor/view_berkas5') }}/{{ encrypt($item->id_banjir_bocor) }}"
                                                        target="_blank">
                                                        <i class="fa fa-eye"></i>
                                                    </a></td>
                                            @else
                                                <td></td>
                                            @endif
                                        @endif
                                        {{-- <td>{{ $item->created_by }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>{{ $item->updated_by }}</td>
                                        <td>{{ $item->updated_at_bpbd }}</td>
                                        <td>{{ $item->updated_by_bpbd }}</td> --}}
                                        <td>
                                            <div class="btn-group">
                                                @if (session('nama_role') == 'OPERATOR')
                                                    <a class="btn btn-primary" title="Kirim Ke Balai"
                                                        href="{{ url('transaksi/bocor/kirim') }}/{{ encrypt($item->id_banjir_bocor) }}/BALAI">
                                                        <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                    <a class="btn btn-danger alert_notif" id="notif" title="Hapus"
                                                        href="{{ url('transaksi/bocor/hapus') }}/{{ encrypt($item->id_banjir_bocor) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @elseif(session('nama_role') == 'BALAI')
                                                    @if (session('menu') == 1)
                                                        <div class="dropdown">
                                                            <a class="btn btn-primary dropdown-toggle"
                                                                title="Pilih Peta Kondisi" href="#" role="button"
                                                                id="dropdownMenuLink" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"> Pilih Peta
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                @foreach ($peta as $map)
                                                                    {{-- <a class="btn btn-dark" title="Lihat Peta"
                                                                        href="{{ url('peta/lihat') }}/{{ encrypt($item->id_peta) }}"
                                                                        target="_blank">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a> --}}
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('peta/status') }}/{{ encrypt($map->id_peta) }}/{{ encrypt($item->id_banjir_bocor) }}"
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
                                                            <div class="dropdown">
                                                                <a class="btn btn-primary dropdown-toggle" href="#"
                                                                    role="button" id="dropdownMenuLink"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false"> Kirim
                                                                    Pemberitahuan
                                                                    Dengan Status
                                                                </a>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuLink">
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('transaksi/bocor/tandakirim') }}/{{ encrypt($item->id_banjir_bocor) }}/1"
                                                                        title="Kirim Tanda WASPADA 1">WASPADA 1</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('transaksi/bocor/tandakirim') }}/{{ encrypt($item->id_banjir_bocor) }}/2"
                                                                        title="Kirim Tanda WASPADA 2">WASPADA 2</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('transaksi/bocor/tandakirim') }}/{{ encrypt($item->id_banjir_bocor) }}/3"
                                                                        title="Kirim Tanda SIAGA">SIAGA</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('transaksi/bocor/tandakirim') }}/{{ encrypt($item->id_banjir_bocor) }}/4"
                                                                        title="Kirim Tanda AWAS">AWAS</a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="alert alert-danger" status="alert">Tidak Memiliki Akses
                                                        </div>
                                                    @endif
                                                @elseif(session('nama_role') == 'BPBD')
                                                    @if (session('menu') == 1)
                                                        <a class="btn btn-dark" title="Lihat Peta"
                                                            href="{{ url('peta/lihat') }}/{{ encrypt($item->id_peta) }}"
                                                            target="_blank">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a class="btn btn-primary" title="Kirim Pemberitahuan Ke Penduduk"
                                                            href="{{ url('transaksi/bocor/kirim') }}/{{ encrypt($item->id_banjir_bocor) }}/PENDUDUK">
                                                            <i class="fa fa-arrow-right"></i>
                                                        </a>
                                                    @else
                                                        <div class="alert alert-danger" status="alert">Tidak Memiliki
                                                            Akses
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
