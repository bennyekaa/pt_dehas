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
            <h1 class="h3 mb-0 text-gray-800">Bendungan Tamblang</h1>
        </div>

        <div class="col-lg-11">
            <h1 class="h5 mb-1 text-primary">Deskripsi Bendungan</h1>
            <div class="card mb-4">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <td>Nama bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan->nama_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>Lokasi bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan->lokasi_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>Nama Sungai</td>
                                <td>:</td>
                                <td>{{ $bendungan->nama_sungai }} </td>
                            </tr>
                            <tr>
                                <td>Posisi bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan->koordinat_bendungan_x }} LS dan {{ $bendungan->koordinat_bendungan_y }} BT</td>
                            </tr>
                            <tr>
                                <td>Pengelola bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan->pengelola_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>No. Telepon</td>
                                <td>:</td>
                                <td>{{ $bendungan->telp_pengelola_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>Alamat Pengelola bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan->alamat_pengelola_bendungan }} </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-11">
            <h1 class="h5 mb-1 text-primary">Tubuh Bendungan</h1>
            <div class="card mb-4">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <td>Tipe Bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan->type_tubuh_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>Panjang Puncak Bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan->panjang_puncak_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Tinggi Bendungan diukur dari dasar sungai</td>
                                <td>:</td>
                                <td>{{ $bendungan->tinggi_dari_sungai_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Tinggi Bendungan diukur dari fondasi</td>
                                <td>:</td>
                                <td>{{ $bendungan->tinggi_dari_fondasi_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Lebar Puncak Bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan->lebar_puncak_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Elevasi Puncak Bendungan</td>
                                <td>:</td>
                                <td>EL. {{ $bendungan->elevasi_puncak_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Daerah Tangkapan Air (cathment area)</td>
                                <td>:</td>
                                <td>{{ $bendungan->daerah_tangkapan_tubuh_bendungan }} km persegi</td>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-lg-11">
            <h1 class="h5 mb-1 text-primary">Bangunan Pelimpah</h1>
            <div class="card mb-4">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <td>Tipe</td>
                                <td>:</td>
                                <td>{{ $bendungan->tipe_bangunan_pelimpah }} </td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td>{{ $bendungan->lokasi_bangunan_pelimpah }} </td>
                            </tr>
                            <tr>
                                <td>Lebar Pelimpah</td>
                                <td>:</td>
                                <td>{{ $bendungan->lebar_bangunan_pelimpah }} m</td>
                            </tr>
                            <tr>
                                <td>Elevasi Ambang</td>
                                <td>:</td>
                                <td>EL. {{ $bendungan->elevasi_bangunan_pelimpah }} m</td>
                            </tr>
                            <tr>
                                <td>Debit inflow Qin PMF</td>
                                <td>:</td>
                                <td>{{ $bendungan->debit_inflow_qin_bangunan_pelimpah }} m3/detik</td>
                            </tr>
                            <tr>
                                <td>Debit inflow Q1000th</td>
                                <td>:</td>
                                <td>{{ $bendungan->debit_inflow_q1000_bangunan_pelimpah }} m3/detik</td>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-lg-11">
            <h1 class="h5 mb-1 text-primary">Bangunan Pengambilan / Pengeluaran</h1>
            <div class="card mb-4">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <td>Tipe</td>
                                <td>:</td>
                                <td>{{ $bendungan->tipe_bangunan_pengambilan }} </td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td>{{ $bendungan->lokasi_bangunan_pengambilan }} </td>
                            </tr>
                            <tr>
                                <td>Saluran Hantar</td>
                                <td>:</td>
                                <td>{{ $bendungan->saluran_hantar_bangunan_pengambilan }} m</td>
                            </tr>
                            <tr>
                                <td>Diameter Terowongan</td>
                                <td>:</td>
                                <td>{{ $bendungan->diameter_terowongan_bangunan_pengambilan }} m</td>
                            </tr>
                            <tr>
                                <td>Kapasitas Maksimum (pipa irigasi,air baku & emergency) </td>
                                <td>:</td>
                                <td>{{ $bendungan->kapasitas_max_bangunan_pengambilan }} m3/detik</td>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-lg-11">
            <h1 class="h5 mb-1 text-primary">Waduk</h1>
            <div class="card mb-4">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <td>Elev. muka air banjir, PMF</td>
                                <td>:</td>
                                <td>EL. {{ $bendungan->elev_muka_air_waduk }} m</td>
                            </tr>
                            <tr>
                                <td>Kapasitas Tampungan Waduk (NWL)</td>
                                <td>:</td>
                                <td>{{ $bendungan->kapasitas_waduk }} juta m3</td>
                            </tr>
                            <tr>
                                <td>Luas Genangan Waduk (NWL) </td>
                                <td>:</td>
                                <td>{{ $bendungan->luas_genangan_waduk }} Ha</td>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>

    </div>
    @endsection


</body>

</html>