@extends('layouts.app')

<!DOCTYPE html>
<html>

<head>
    <title>PT Dehas Inframedia Karsa - Bendungan</title>
</head>

<body>

    @section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Bendungan</h1>
        </div>

        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a class="btn btn-primary" href="/bendungan/tambah" style="float: left;"> + Tambah Data Bendungan</a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Bendungan</th>
                                <th>Lokasi Bendungan</th>
                                <th>Nama Sungai</th>
                                <th>koordinat Bendungan X</th>
                                <th>Koordinat Bendungan Y</th>
                                <th>Pengelola Bendungan</th>
                                <th>Telpon Pengelola Bendungan</th>
                                <th>Alamat Pengelola Bendungan</th>
                                <th>Type Tubuh Bendungan</th>
                                <th>Tinggi Bendungan diukur dari dasar sungai</th>
                                <th>Panjang Puncak Tubuh Bendungan</th>
                                <th>Tinggi Dari Fondasi Tubuh Bendungan</th>
                                <th>Lebar Puncak Tubuh Bendungan</th>
                                <th>Elevasi Puncak Tubuh Bendungan</th>
                                <th>Daerah Tangkapan Tubuh Bendungan</th>
                                <th>Tipe Bangunan Pelimpah</th>
                                <th>Lokasi Bangunan Pelimpah</th>
                                <th>Lebar Bangunan Pelimpah</th>
                                <th>Elevasi Bangunan Pelimpah</th>
                                <th>Debit Inflow Qin Bangunan Pelimpah</th>
                                <th>Debit Inflow Q1000 Bangunan Pelimpah</th>
                                <th>Tipe Bangunan Pengambilan</th>
                                <th>Lokasi Bangunan Pengambilan</th>
                                <th>Saluran Hantar Bangunan Pengambilan</th>
                                <th>Diameter Hantar Bangunan Pengambilan</th>
                                <th>Kapasitas Max Bangunan Pengambilan</th>
                                <th>Elevation Muka Air Waduk</th>
                                <th>Kapasitas Waduk</th>
                                <th>Luas Genangan Waduk</th>
                                <th>Dibuat Pada</th>
                                <th>Dibuat Oleh</th>
                                <th>Diuptade Pada</th>
                                <th>Diupdate Oleh</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach($bendungan as $p)
                        <thead class="thead-light">
                            <tr>

                                <td>{{ $p->nama_bendungan }} </td>
                                <td>{{ $p->lokasi_bendungan }} </td>
                                <td>{{ $p->nama_sungai }} </td>
                                <td>{{ $p->koordinat_bendungan_x }} </td>
                                <td>{{ $p->koordinat_bendungan_y }} </td>
                                <td>{{ $p->pengelola_bendungan }} </td>
                                <td>{{ $p->telp_pengelola_bendungan }} </td>
                                <td>{{ $p->alamat_pengelola_bendungan }} </td>
                                <td>{{ $p->type_tubuh_bendungan }} </td>
                                <td>{{ $p->panjang_puncak_tubuh_bendungan }} </td>
                                <td>{{ $p->tinggi_dari_sungai_tubuh_bendungan }} </td>
                                <td>{{ $p->tinggi_dari_fondasi_tubuh_bendungan }} </td>
                                <td>{{ $p->lebar_puncak_tubuh_bendungan }} </td>
                                <td>{{ $p->elevasi_puncak_tubuh_bendungan }} </td>
                                <td>{{ $p->daerah_tangkapan_tubuh_bendungan }} </td>
                                <td>{{ $p->tipe_bangunan_pelimpah }} </td>
                                <td>{{ $p->lokasi_bangunan_pelimpah }} </td>
                                <td>{{ $p->lebar_bangunan_pelimpah }} </td>
                                <td>{{ $p->elevasi_bangunan_pelimpah }} </td>
                                <td>{{ $p->debit_inflow_qin_bangunan_pelimpah }} </td>
                                <td>{{ $p->debit_inflow_q1000_bangunan_pelimpah }} </td>
                                <td>{{ $p->tipe_bangunan_pengambilan }} </td>
                                <td>{{ $p->lokasi_bangunan_pengambilan }} </td>
                                <td>{{ $p->saluran_hantar_bangunan_pengambilan }} </td>
                                <td>{{ $p->diameter_terowongan_bangunan_pengambilan }} </td>
                                <td>{{ $p->kapasitas_max_bangunan_pengambilan }} </td>
                                <td>{{ $p->elev_muka_air_waduk }} </td>
                                <td>{{ $p->kapasitas_waduk }} </td>
                                <td>{{ $p->luas_genangan_waduk }} </td>
                                <td>{{ $p->created_at }}</td>
                                <td>{{ $p->created_by }}</td>
                                <td>{{ $p->updated_at }}</td>
                                <td>{{ $p->updated_by }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-warning" title="Edit" href="/bendungan/edit/{{ encrypt($p->id_bendungan) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger" title="Hapus" href="/bendungan/hapus/{{ $p->id_bendungan }}">
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


</body>

</html>