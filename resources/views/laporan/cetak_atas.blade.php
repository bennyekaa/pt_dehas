<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <img src="{{ asset('assets/img/Pemali Juana_1.jpg') }}">
    <div class="table-responsive">
        <table class="table">
            <thead>
                {{-- <caption colspan="10" style="text-align: center">LAPORAN HARIAN</caption> --}}
                <tr>
                    <td colspan="2" rowspan="3">Nama Bendungan</td>
                    <td>{{ $bendungan->nama_bendungan }}</td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="3">Unit Kerja</td>
                    <td>{{ $bendungan->pengelola_bendungan }}</td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="3">Lokasi</td>
                    <td>{{ $bendungan->lokasi_bendungan }}</td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="3">Hari / Tanggal</td>
                    <td>
                        @if (empty($hari1))
                            {{ $hari2 }} / {{ date('d-m-Y', strtotime($selesai)) }}
                        @elseif(empty($hari2))
                            {{ $hari1 }} / {{ date('d-m-Y', strtotime($mulai)) }}
                        @else
                            {{ $hari1 }} / {{   date('d-m-Y', strtotime($mulai)) }} - {{ $hari2 }} / {{ date('d-m-Y', strtotime($selesai)) }}
                        @endif
                    </td>
                </tr>
                {{-- <tr>
                    <th>No</th>
                    <th>Waktu Pencatatan</th>
                    <th>Status</th>
                    <th>Muka Air (Meter)</th>
                    <th>Debit Outflow (m3/detik)</th>
                    <th>Kejadian</th>
                    <th>Dokumentasi 1</th>
                    <th>Dokumentasi 2</th>
                    <th>Dokumentasi 3</th>
                    <th>Dokumentasi 4</th>
                    <th>Dokumentasi 5</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($laporan as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ date('d-m-Y H:i:s', strtotime($item->updated_at)) }}</td>
                        <td>
                            @if (empty($item->status_muka_air))
                                @if ($item->status_bocor == 0)
                                    {{ 'NORMAL' }}
                                @elseif ($item->status_bocor == 1)
                                    {{ 'WASPADA 1' }}
                                @elseif($item->status_bocor == 2)
                                    {{ 'WASPADA 2' }}
                                @elseif($item->status_bocor == 3)
                                    {{ 'SIAGA' }}
                                @elseif($item->status_bocor == 4)
                                    {{ 'AWAS' }}
                                @else
                                    {{ 'BAHAYA' }}
                                @endif
                            @else
                                @if ($item->status_muka_air == 0)
                                    {{ 'NORMAL' }}
                                @elseif ($item->status_muka_air == 1)
                                    {{ 'WASPADA 1' }}
                                @elseif($item->status_muka_air == 2)
                                    {{ 'WASPADA 2' }}
                                @elseif($item->status_muka_air == 3)
                                    {{ 'SIAGA' }}
                                @elseif($item->status_muka_air == 4)
                                    {{ 'AWAS' }}
                                @else
                                    {{ 'BAHAYA' }}
                                @endif
                            @endif
                        </td>
                        <td>{{ empty($item->tinggi_muka_air) ? $item->tinggi_bocor : $item->tinggi_muka_air }}</td>
                        <td>{{ empty($item->debit_air) ? $item->debit : $item->debit_air }}</td>
                        <td>{{ $item->pesan_default }}</td>
                        <td>
                            @if (!empty($item->file_1))
                                <img src="{{ Storage::url($item->file_1) }}" class="img-fluid" alt="Responsive image">
                            @endif
                        </td>
                        <td>
                            @if (!empty($item->file_2))
                                <img src="{{ Storage::url($item->file_2) }}" class="img-fluid" alt="Responsive image">
                            @endif
                        </td>
                        <td>
                            @if (!empty($item->file_3))
                                <img src="{{ Storage::url($item->file_3) }}" class="img-fluid" alt="Responsive image">
                            @endif
                        </td>
                        <td>
                            @if (!empty($item->file_4))
                                <img src="{{ Storage::url($item->file_4) }}" class="img-fluid" alt="Responsive image">
                            @endif
                        </td>
                        <td>
                            @if (!empty($item->file_5))
                                <img src="{{ Storage::url($item->file_5) }}" class="img-fluid" alt="Responsive image">
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody> --}}
        </table>
    </div>
</body>

</html>
