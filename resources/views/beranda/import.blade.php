@extends('layouts.app')

@section('content')

<body>

    <main class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="h3 mb-0 text-primary">Tambah Bendungan</h1>
                <form action="/bendungan/tambahproses" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="nama_bendungan" class="col-form-label text-md-end">{{ ('Nama Bendungan') }}</label>
                            <input id="nama_bendungan" type="text" class="form-control @error('nama_bendungan') is-invalid @enderror" name="nama_bendungan" required autocomplete="name" autofocus>

                            <label for="lokasi_bendungan" class="col-form-label text-md-end">{{ ('Lokasi Bendungan') }}</label>
                            <input id="lokasi_bendungan" type="text" class="form-control @error('lokasi_bendungan') is-invalid @enderror" name="lokasi_bendungan" required autocomplete="name" autofocus>

                            <label for="nama_sungai" class="col-form-label text-md-end">{{ ('Nama Sungai') }}</label>
                            <input id="nama_sungai" type="text" class="form-control @error('nama_sungai') is-invalid @enderror" name="nama_sungai" required autocomplete="email">

                            <label for="koordinat_bendungan_x" class="col-form-label">{{ ('Koordinat Bendungan X') }}</label>
                            <input id="koordinat_bendungan_x" type="text" class="form-control @error('koordinat_bendungan_x') is-invalid @enderror" name="koordinat_bendungan_x" required autocomplete="new-koordinat_bendungan_x">

                            <label for="koordinat_bendungan_y" class="col-form-label text-md-end">{{ ('Koordinat Bendungan Y') }}</label>
                            <input id="koordinat_bendungan_y" type="text" class="form-control @error('koordinat_bendungan_y') is-invalid @enderror" name="koordinat_bendungan_y" required autocomplete="new-koordinat_bendungan_y">

                            <label for="pengelola_bendungan" class="col-form-label text-md-end">{{ ('Pengelola Bendungan') }}</label>
                            <input id="pengelola_bendungan" type="text" class="form-control @error('pengelola_bendungan') is-invalid @enderror" name="pengelola_bendungan" required autocomplete="new-pengelola_bendungan">

                            <label for="telp_pengelola_bendungan" class="col-form-label text-md-end">{{ ('No Telp') }}</label>
                            <input id="telp_pengelola_bendungan" type="text" class="form-control @error('telp_pengelola_bendungan') is-invalid @enderror" name="telp_pengelola_bendungan" required autocomplete="new-telp_pengelola_bendungan">

                            <label for="alamat_pengelola_bendungan" class="col-form-label text-md-end">{{ ('Alamat Pengelola Bendungan') }}</label>
                            <input id="alamat_pengelola_bendungan" type="text" class="form-control @error('alamat_pengelola_bendungan') is-invalid @enderror" name="alamat_pengelola_bendungan" required autocomplete="new-alamat_pengelola_bendungan">

                            <label for="type_tubuh_bendungan" class="col-form-label text-md-end">{{ ('Tipe Tubuh Bendungan') }}</label>
                            <input id="type_tubuh_bendungan" type="text" class="form-control @error('type_tubuh_bendungan') is-invalid @enderror" name="type_tubuh_bendungan" required autocomplete="new-type_tubuh_bendungan">

                            <label for="panjang_puncak_tubuh_bendungan" class="col-form-label text-md-end">{{ ('Panjang Puncak Tubuh Bendungan') }}</label>
                            <input id="panjang_puncak_tubuh_bendungan" type="text" class="form-control @error('panjang_puncak_tubuh_bendungan') is-invalid @enderror" name="panjang_puncak_tubuh_bendungan" required autocomplete="panjang_puncak_tubuh_bendungan">
                        </div>

                        <div class="col-md-4">
                            <div>
                                <label for="tinggi_dari_sungai_tubuh_bendungan" class="col-form-label text-md-end">{{ ('Tinggi Dari Sungai Tubuh Bendungan') }}</label>
                                <input id="tinggi_dari_sungai_tubuh_bendungan" type="text" class="form-control @error('tinggi_dari_sungai_tubuh_bendungan') is-invalid @enderror" name="tinggi_dari_sungai_tubuh_bendungan" required autocomplete="tinggi_dari_sungai_tubuh_bendungan">
                            </div>

                            <div>
                                <label for="tinggi_dari_fondasi_tubuh_bendungan" class="col-form-label text-md-end">{{ ('Tinggi Dari Fondasi Tubuh Bendungan') }}</label>
                                <input id="tinggi_dari_fondasi_tubuh_bendungan" type="text" class="form-control @error('tinggi_dari_fondasi_tubuh_bendungan') is-invalid @enderror" name="tinggi_dari_fondasi_tubuh_bendungan" required autocomplete="tinggi_dari_fondasi_tubuh_bendungan">
                            </div>

                            <div>
                                <label for="lebar_puncak_tubuh_bendungan" class="col-form-label text-md-end">{{ ('Lebar Puncak Tubuh Bendungan') }}</label>
                                <input id="lebar_puncak_tubuh_bendungan" type="text" class="form-control @error('lebar_puncak_tubuh_bendungan') is-invalid @enderror" name="lebar_puncak_tubuh_bendungan" required autocomplete="lebar_puncak_tubuh_bendungan">
                            </div>

                            <div>
                                <label for="elevasi_puncak_tubuh_bendungan" class="col-form-label text-md-end">{{ ('Elevasi Puncak Tubuh Bendungan') }}</label>
                                <input id="elevasi_puncak_tubuh_bendungan" type="text" class="form-control @error('elevasi_puncak_tubuh_bendungan') is-invalid @enderror" name="elevasi_puncak_tubuh_bendungan" required autocomplete="elevasi_puncak_tubuh_bendungan">
                            </div>

                            <div>
                                <label for="daerah_tangkapan_tubuh_bendungan" class="col-form-label text-md-end">{{ ('Daerah Tangkapan Tubuh Bendungan') }}</label>
                                <input id="daerah_tangkapan_tubuh_bendungan" type="text" class="form-control @error('daerah_tangkapan_tubuh_bendungan') is-invalid @enderror" name="daerah_tangkapan_tubuh_bendungan" required autocomplete="daerah_tangkapan_tubuh_bendungan">
                            </div>

                            <div>
                                <label for="tipe_bangunan_pelimpah" class="col-form-label text-md-end">{{ ('Tipe Bangunan Pelimpah') }}</label>
                                <input id="tipe_bangunan_pelimpah" type="text" class="form-control @error('tipe_bangunan_pelimpah') is-invalid @enderror" name="tipe_bangunan_pelimpah" required autocomplete="tipe_bangunan_pelimpah">
                            </div>

                            <div>
                                <label for="lokasi_bangunan_pelimpah" class="col-form-label text-md-end">{{ ('Lokasi Bangunan Pelimpah') }}</label>
                                <input id="lokasi_bangunan_pelimpah" type="text" class="form-control @error('lokasi_bangunan_pelimpah') is-invalid @enderror" name="lokasi_bangunan_pelimpah" required autocomplete="lokasi_bangunan_pelimpah">
                            </div>

                            <div>
                                <label for="lebar_bangunan_pelimpah" class="col-form-label text-md-end">{{ ('Lebar Bangunan Pelimpah') }}</label>
                                <input id="lebar_bangunan_pelimpah" type="text" class="form-control @error('lebar_bangunan_pelimpah') is-invalid @enderror" name="lebar_bangunan_pelimpah" required autocomplete="lebar_bangunan_pelimpah">
                            </div>

                            <div>
                                <label for="elevasi_bangunan_pelimpah" class="col-form-label text-md-end">{{ ('Elevasi Bangunan Pelimpah') }}</label>
                                <input id="elevasi_bangunan_pelimpah" type="text" class="form-control @error('elevasi_bangunan_pelimpah') is-invalid @enderror" name="elevasi_bangunan_pelimpah" required autocomplete="elevasi_bangunan_pelimpah">
                            </div>

                            <div>
                                <label for="debit_inflow_qin_bangunan_pelimpah" class="col-form-label text-md-end">{{ ('Debit Inflow Qin Bangunan Pelimpah') }}</label>
                                <input id="debit_inflow_qin_bangunan_pelimpah" type="text" class="form-control @error('debit_inflow_qin_bangunan_pelimpah') is-invalid @enderror" name="debit_inflow_qin_bangunan_pelimpah" required autocomplete="debit_inflow_qin_bangunan_pelimpah">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="debit_inflow_q1000_bangunan_pelimpah" class="col-form-label text-md-end" style="font-weight:bold">{{ ('Debit Inflow Q1000 Bangunan Pelimpah') }}</label>
                            <input id="debit_inflow_q1000_bangunan_pelimpah" type="text" class="form-control @error('debit_inflow_q1000_bangunan_pelimpah') is-invalid @enderror" name="debit_inflow_q1000_bangunan_pelimpah" required autocomplete="debit_inflow_q1000_bangunan_pelimpah">

                            <label for="tipe_bangunan_pengambilan" class="col-form-label text-md-end" style="font-weight:bold">{{ ('Tipe Bangunan Pengambilan') }}</label>
                            <input id="tipe_bangunan_pengambilan" type="text" class="form-control @error('tipe_bangunan_pengambilan') is-invalid @enderror" name="tipe_bangunan_pengambilan" required autocomplete="tipe_bangunan_pengambilan">

                            <label for="lokasi_bangunan_pengambilan" class="col-form-label text-md-end" style="font-weight:bold">{{ ('Lokasi Bangunan Pengambilan') }}</label>
                            <input id="lokasi_bangunan_pengambilan" type="text" class="form-control @error('lokasi_bangunan_pengambilan') is-invalid @enderror" name="lokasi_bangunan_pengambilan" required autocomplete="lokasi_bangunan_pengambilan">

                            <label for="saluran_hantar_bangunan_pengambilan" class="col-form-label text-md-end" style="font-weight:bold">{{ ('Saluran Hantar Bangunan Pengambilan') }}</label>
                            <input id="saluran_hantar_bangunan_pengambilan" type="text" class="form-control @error('saluran_hantar_bangunan_pengambilan') is-invalid @enderror" name="saluran_hantar_bangunan_pengambilan" required autocomplete="saluran_hantar_bangunan_pengambilan">

                            <label for="diameter_terowongan_bangunan_pengambilan" class="col-form-label text-md-end" style="font-weight:bold">{{ ('Diameter Terowongan Bangunan Pengambilan') }}</label>
                            <input id="diameter_terowongan_bangunan_pengambilan" type="text" class="form-control @error('diameter_terowongan_bangunan_pengambilan') is-invalid @enderror" name="diameter_terowongan_bangunan_pengambilan" required autocomplete="diameter_terowongan_bangunan_pengambilan">

                            <label for="kapasitas_max_bangunan_pengambilan" class="col-form-label text-md-end" style="font-weight:bold">{{ ('Kapasitas Terowongan Bangunan Pengambilan') }}</label>
                            <input id="kapasitas_max_bangunan_pengambilan" type="text" class="form-control @error('kapasitas_max_bangunan_pengambilan') is-invalid @enderror" name="kapasitas_max_bangunan_pengambilan" required autocomplete="kapasitas_max_bangunan_pengambilan">

                            <label for="elev_muka_air_waduk" class="col-form-label text-md-end" style="font-weight:bold">{{ ('Elev Muka Air Waduk') }}</label>
                            <input id="elev_muka_air_waduk" type="text" class="form-control @error('elev_muka_air_waduk') is-invalid @enderror" name="elev_muka_air_waduk" required autocomplete="elev_muka_air_waduk">

                            <label for="kapasitas_waduk" class="col-form-label text-md-end" style="font-weight:bold">{{ ('Kapasitas Waduk') }}</label>
                            <input id="kapasitas_waduk" type="text" class="form-control @error('kapasitas_waduk') is-invalid @enderror" name="kapasitas_waduk" required autocomplete="kapasitas_waduk">

                            <label for="luas_genangan_waduk" class="col-form-label text-md-end" style="font-weight:bold">{{ ('Luas Genangan Waduk') }}</label>
                            <input id=" luas_genangan_waduk" type="text" class="form-control @error('luas_genangan_waduk') is-invalid @enderror" name="luas_genangan_waduk" required autocomplete="luas_genangan_waduk">

                            <div style="margin-top: 40px;">
                                <button type="submit" class="btn btn-primary" style="width: 50%;">
                                    {{ ('Tambah') }}
                                </button>
                            </div>

                        </div>
                </form>
            </div>
        </div>
    </main>
</body>
@endsection

</html>