@extends('layouts.app')
    @section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail {{$bendungan[0]->nama_bendungan}}</h1>
        </div>

        <div class="col-lg-11">
            <h1 class="h5 mb-1 text-primary">Deskripsi Bendungan</h1>
            <div class="card mb-4">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <td style="width: 35%">Nama bendungan</td>
                                <td style="width: 5%">:</td>
                                <td style="width: 60%; text-align: left">{{ $bendungan[0]->nama_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>Lokasi bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->lokasi_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>Nama Sungai</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->nama_sungai }} </td>
                            </tr>
                            <tr>
                                <td>Posisi bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->koordinat_bendungan_x }} LS dan {{ $bendungan[0]->koordinat_bendungan_y }} BT</td>
                            </tr>
                            <tr>
                                <td>Pengelola bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->pengelola_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>No. Telepon</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->telp_pengelola_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>Alamat Pengelola bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->alamat_pengelola_bendungan }} </td>
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
                    <table class="table align-items-center table-flush" >
                        <thead class="thead-light">
                            <tr>
                                <td style="width: 35%">Tipe Bendungan</td>
                                <td style="width: 5%">:</td>
                                <td style="width: 60%;text-align: left">{{ $bendungan[0]->type_tubuh_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>Panjang Puncak Bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->panjang_puncak_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Tinggi Bendungan diukur dari dasar sungai</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->tinggi_dari_sungai_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Tinggi Bendungan diukur dari fondasi</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->tinggi_dari_fondasi_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Lebar Puncak Bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->lebar_puncak_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Elevasi Puncak Bendungan</td>
                                <td>:</td>
                                <td>EL. {{ $bendungan[0]->elevasi_puncak_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Daerah Tangkapan Air (cathment area)</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->daerah_tangkapan_tubuh_bendungan }} km persegi</td>
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
                    <table class="table align-items-center table-flush" >
                        <thead class="thead-light">
                            <tr>
                                <td style="width: 35%">Tipe</td>
                                <td style="width: 5%">:</td>
                                <td style="width: 60%;text-align: left">{{ $bendungan[0]->tipe_bangunan_pelimpah }} </td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->lokasi_bangunan_pelimpah }} </td>
                            </tr>
                            <tr>
                                <td>Lebar Pelimpah</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->lebar_bangunan_pelimpah }} m</td>
                            </tr>
                            <tr>
                                <td>Elevasi Ambang</td>
                                <td>:</td>
                                <td>EL. {{ $bendungan[0]->elevasi_bangunan_pelimpah }} m</td>
                            </tr>
                            <tr>
                                <td>Debit inflow Qin PMF</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->debit_inflow_qin_bangunan_pelimpah }} m3/detik</td>
                            </tr>
                            <tr>
                                <td>Debit inflow Q1000th</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->debit_inflow_q1000_bangunan_pelimpah }} m3/detik</td>
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
                    <table class="table align-items-center table-flush" >
                        <thead class="thead-light">
                            <tr>
                                <td style="width: 35%">Tipe</td>
                                <td style="width: 5%">:</td>
                                <td style="width: 60%;text-align: left">{{ $bendungan[0]->tipe_bangunan_pengambilan }} </td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->lokasi_bangunan_pengambilan }} </td>
                            </tr>
                            <tr>
                                <td>Saluran Hantar</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->saluran_hantar_bangunan_pengambilan }} m</td>
                            </tr>
                            <tr>
                                <td>Diameter Terowongan</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->diameter_terowongan_bangunan_pengambilan }} m</td>
                            </tr>
                            <tr>
                                <td>Kapasitas Maksimum (pipa irigasi,air baku & emergency) </td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->kapasitas_max_bangunan_pengambilan }} m3/detik</td>
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
                    <table class="table align-items-center table-flush" >
                        <thead class="thead-light">
                            <tr>
                                <td style="width: 35%">Elev. muka air banjir, PMF</td>
                                <td style="width: 5%">:</td>
                                <td style="width: 60%;text-align: left">EL. {{ $bendungan[0]->elev_muka_air_waduk }} m</td>
                            </tr>
                            <tr>
                                <td>Kapasitas Tampungan Waduk (NWL)</td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->kapasitas_waduk }} juta m3</td>
                            </tr>
                            <tr>
                                <td>Luas Genangan Waduk (NWL) </td>
                                <td>:</td>
                                <td>{{ $bendungan[0]->luas_genangan_waduk }} Ha</td>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>

    </div>
    {{-- <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail {{$bendungan[1]->nama_bendungan}}</h1>
        </div>

        <div class="col-lg-11">
            <h1 class="h5 mb-1 text-primary">Deskripsi Bendungan</h1>
            <div class="card mb-4">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <td style="width: 35%">Nama bendungan</td>
                                <td style="width: 5%">:</td>
                                <td style="width: 60%; text-align: left">{{ $bendungan[1]->nama_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>Lokasi bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->lokasi_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>Nama Sungai</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->nama_sungai }} </td>
                            </tr>
                            <tr>
                                <td>Posisi bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->koordinat_bendungan_x }} LS dan {{ $bendungan[1]->koordinat_bendungan_y }} BT</td>
                            </tr>
                            <tr>
                                <td>Pengelola bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->pengelola_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>No. Telepon</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->telp_pengelola_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>Alamat Pengelola bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->alamat_pengelola_bendungan }} </td>
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
                    <table class="table align-items-center table-flush" >
                        <thead class="thead-light">
                            <tr>
                                <td style="width: 35%">Tipe Bendungan</td>
                                <td style="width: 5%">:</td>
                                <td style="width: 60%;text-align: left">{{ $bendungan[1]->type_tubuh_bendungan }} </td>
                            </tr>
                            <tr>
                                <td>Panjang Puncak Bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->panjang_puncak_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Tinggi Bendungan diukur dari dasar sungai</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->tinggi_dari_sungai_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Tinggi Bendungan diukur dari fondasi</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->tinggi_dari_fondasi_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Lebar Puncak Bendungan</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->lebar_puncak_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Elevasi Puncak Bendungan</td>
                                <td>:</td>
                                <td>EL. {{ $bendungan[1]->elevasi_puncak_tubuh_bendungan }} m</td>
                            </tr>
                            <tr>
                                <td>Daerah Tangkapan Air (cathment area)</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->daerah_tangkapan_tubuh_bendungan }} km persegi</td>
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
                    <table class="table align-items-center table-flush" >
                        <thead class="thead-light">
                            <tr>
                                <td style="width: 35%">Tipe</td>
                                <td style="width: 5%">:</td>
                                <td style="width: 60%;text-align: left">{{ $bendungan[1]->tipe_bangunan_pelimpah }} </td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->lokasi_bangunan_pelimpah }} </td>
                            </tr>
                            <tr>
                                <td>Lebar Pelimpah</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->lebar_bangunan_pelimpah }} m</td>
                            </tr>
                            <tr>
                                <td>Elevasi Ambang</td>
                                <td>:</td>
                                <td>EL. {{ $bendungan[1]->elevasi_bangunan_pelimpah }} m</td>
                            </tr>
                            <tr>
                                <td>Debit inflow Qin PMF</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->debit_inflow_qin_bangunan_pelimpah }} m3/detik</td>
                            </tr>
                            <tr>
                                <td>Debit inflow Q1000th</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->debit_inflow_q1000_bangunan_pelimpah }} m3/detik</td>
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
                    <table class="table align-items-center table-flush" >
                        <thead class="thead-light">
                            <tr>
                                <td style="width: 35%">Tipe</td>
                                <td style="width: 5%">:</td>
                                <td style="width: 60%;text-align: left">{{ $bendungan[1]->tipe_bangunan_pengambilan }} </td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->lokasi_bangunan_pengambilan }} </td>
                            </tr>
                            <tr>
                                <td>Saluran Hantar</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->saluran_hantar_bangunan_pengambilan }} m</td>
                            </tr>
                            <tr>
                                <td>Diameter Terowongan</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->diameter_terowongan_bangunan_pengambilan }} m</td>
                            </tr>
                            <tr>
                                <td>Kapasitas Maksimum (pipa irigasi,air baku & emergency) </td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->kapasitas_max_bangunan_pengambilan }} m3/detik</td>
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
                    <table class="table align-items-center table-flush" >
                        <thead class="thead-light">
                            <tr>
                                <td style="width: 35%">Elev. muka air banjir, PMF</td>
                                <td style="width: 5%">:</td>
                                <td style="width: 60%;text-align: left">EL. {{ $bendungan[1]->elev_muka_air_waduk }} m</td>
                            </tr>
                            <tr>
                                <td>Kapasitas Tampungan Waduk (NWL)</td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->kapasitas_waduk }} juta m3</td>
                            </tr>
                            <tr>
                                <td>Luas Genangan Waduk (NWL) </td>
                                <td>:</td>
                                <td>{{ $bendungan[1]->luas_genangan_waduk }} Ha</td>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>

    </div> --}}
    @endsection
