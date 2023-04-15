@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form action="{{url('prosesbendungan')}}" method="post">

                        @csrf
                        <input type="hidden" name="id_bendungan" value="{{$data->id_bendungan}}">
                        <div class="row mb-3">
                            <label for="id_bendungan" class="col-md-4 col-form-label text-md-end">{{ __('ID Bendungan') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('id_bendungan') is-invalid @enderror" name="id_bendungan" value="{{$data->id_bendungan}}" required autocomplete="name" autofocus>

                                @error('bendungan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama_bendungan" class="col-md-4 col-form-label text-md-end">{{ __('Nama Bendungan') }}</label>

                            <div class="col-md-6">
                                <input id="nama_bendungan" type="text" class="form-control @error('nama_bendungan') is-invalid @enderror" name="nama_bendungan" value="{{$data->nama_bendungan}}" required autocomplete="name" autofocus>

                                @error('nama_bendungan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lokasi_bendungan" class="col-md-4 col-form-label text-md-end">{{ __('Lokasi Bendungan') }}</label>

                            <div class="col-md-6">
                                <input id="lokasi_bendungan" type="text" class="form-control @error('lokasi_bendungan') is-invalid @enderror" name="lokasi_bendungan" value="{{$data->lokasi_bendungan}}" required autocomplete="name" autofocus>

                                @error('lokasi_bendungan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama_sungai" class="col-md-4 col-form-label text-md-end">{{ __('Nama Sungai') }}</label>

                            <div class="col-md-6">
                                <input id="nama_sungai" type="text" class="form-control @error('nama_sungai') is-invalid @enderror" name="nama_sungai" value="{{$data->nama_sungai}}" required autocomplete="email">

                                @error('nama_sungai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="koordinat_bendungan_x" class="col-md-4 col-form-label text-md-end">{{ __('Koordinat Bendungan X') }}</label>

                            <div class="col-md-6">
                                <input id="koordinat_bendungan_x" type="text" class="form-control @error('koordinat_bendungan_x') is-invalid @enderror" name="koordinat_bendungan_x" value="{{$data->koordinat_bendungan_x}}" required autocomplete="new-koordinat_bendungan_x">

                                @error('koordinat_bendungan_x')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="koordinat_bendungan_y" class="col-md-4 col-form-label text-md-end">{{ __('Koordinat Bendungan Y') }}</label>

                            <div class="col-md-6">
                                <input id="koordinat_bendungan_y" type="text" class="form-control @error('koordinat_bendungan_y') is-invalid @enderror" name="koordinat_bendungan_y" value="{{$data->koordinat_bendungan_y}}" required autocomplete="new-koordinat_bendungan_y">

                                @error('koordinat_bendungan_y')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pengelola_bendungan" class="col-md-4 col-form-label text-md-end">{{ __('Pengelola Bendungan') }}</label>

                            <div class="col-md-6">
                                <input id="pengelola_bendungan" type="text" class="form-control @error('pengelola_bendungan') is-invalid @enderror" name="pengelola_bendungan" value="{{$data->pengelola_bendungan}}" required autocomplete="new-pengelola_bendungan">

                                @error('pengelola_bendungan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="telp_pengelola_bendungan" class="col-md-4 col-form-label text-md-end">{{ __('No Telp') }}</label>

                            <div class="col-md-6">
                                <input id="telp_pengelola_bendungan" type="text" class="form-control @error('telp_pengelola_bendungan') is-invalid @enderror" name="telp_pengelola_bendungan" value="{{$data->telp_pengelola_bendungan}}" required autocomplete="new-telp_pengelola_bendungan">
                                @error('telp_pengelola_bendungan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="alamat_pengelola_bendungan" class="col-md-4 col-form-label text-md-end">{{ __('Alamat Pengelola Bendungan') }}</label>

                            <div class="col-md-6">
                                <input id="alamat_pengelola_bendungan" type="text" class="form-control @error('alamat_pengelola_bendungan') is-invalid @enderror" name="alamat_pengelola_bendungan" value="{{$data->alamat_pengelola_bendungan}}" required autocomplete="new-alamat_pengelola_bendungan">

                                @error('alamat_pengelola_bendungan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type_tubuh_bendungan" class="col-md-4 col-form-label text-md-end">{{ __('Tipe Tubuh Bendungan') }}</label>

                            <div class="col-md-6">
                                <input id="type_tubuh_bendungan" type="text" class="form-control @error('type_tubuh_bendungan') is-invalid @enderror" name="type_tubuh_bendungan" value="{{$data->type_tubuh_bendungan}}" required autocomplete="new-type_tubuh_bendungan">

                                @error('type_tubuh_bendungan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="panjang_puncak_tubuh_bendungan" class="col-md-4 col-form-label text-md-end">{{ __('Panjang Puncak Tubuh Bendungan') }}</label>

                            <div class="col-md-6">
                                <input id="panjang_puncak_tubuh_bendungan" type="text" class="form-control @error('panjang_puncak_tubuh_bendungan') is-invalid @enderror" name="panjang_puncak_tubuh_bendungan" value="{{$data->panjang_puncak_tubuh_bendungan}}" required autocomplete="panjang_puncak_tubuh_bendungan">

                                @error('panjang_puncak_tubuh_bendungan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tinggi_dari_sungai_tubuh_bendungan" class="col-md-4 col-form-label text-md-end">{{ __('Tinggi Dari Sungai Tubuh Bendungan') }}</label>

                            <div class="col-md-6">
                                <input id="tinggi_dari_sungai_tubuh_bendungan" type="text" class="form-control @error('tinggi_dari_sungai_tubuh_bendungan') is-invalid @enderror" name="tinggi_dari_sungai_tubuh_bendungan" value="{{$data->tinggi_dari_sungai_tubuh_bendungan}}" required autocomplete="tinggi_dari_sungai_tubuh_bendungan">

                                @error('tinggi_dari_sungai_tubuh_bendungan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tinggi_dari_fondasi_tubuh_bendungan" class="col-md-4 col-form-label text-md-end">{{ __('Tinggi Dari Fondasi Tubuh Bendungan') }}</label>

                            <div class="col-md-6">
                                <input id="tinggi_dari_fondasi_tubuh_bendungan" type="text" class="form-control @error('tinggi_dari_fondasi_tubuh_bendungan') is-invalid @enderror" name="tinggi_dari_fondasi_tubuh_bendungan" value="{{$data->tinggi_dari_fondasi_tubuh_bendungan}}" required autocomplete="tinggi_dari_fondasi_tubuh_bendungan">

                                @error('tinggi_dari_fondasi_tubuh_bendungan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lebar_puncak_tubuh_bendungan" class="col-md-4 col-form-label text-md-end">{{ __('Lebar Puncak Tubuh Bendungan') }}</label>

                            <div class="col-md-6">
                                <input id="lebar_puncak_tubuh_bendungan" type="text" class="form-control @error('lebar_puncak_tubuh_bendungan') is-invalid @enderror" name="lebar_puncak_tubuh_bendungan" value="{{$data->lebar_puncak_tubuh_bendungan}}" required autocomplete="lebar_puncak_tubuh_bendungan">

                                @error('lebar_puncak_tubuh_bendungan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="elevasi_puncak_tubuh_bendungan" class="col-md-4 col-form-label text-md-end">{{ __('Elevasi Puncak Tubuh Bendungan') }}</label>

                            <div class="col-md-6">
                                <input id="elevasi_puncak_tubuh_bendungan" type="text" class="form-control @error('elevasi_puncak_tubuh_bendungan') is-invalid @enderror" name="elevasi_puncak_tubuh_bendungan" value="{{$data->elevasi_puncak_tubuh_bendungan}}" required autocomplete="elevasi_puncak_tubuh_bendungan">

                                @error('elevasi_puncak_tubuh_bendungan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="daerah_tangkapan_tubuh_bendungan" class="col-md-4 col-form-label text-md-end">{{ __('Daerah Tangkapan Tubuh Bendungan') }}</label>

                            <div class="col-md-6">
                                <input id="daerah_tangkapan_tubuh_bendungan" type="text" class="form-control @error('daerah_tangkapan_tubuh_bendungan') is-invalid @enderror" name="daerah_tangkapan_tubuh_bendungan" value="{{$data->daerah_tangkapan_tubuh_bendungan}}" required autocomplete="daerah_tangkapan_tubuh_bendungan">

                                @error('daerah_tangkapan_tubuh_bendungan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tipe_bangunan_pelimpah" class="col-md-4 col-form-label text-md-end">{{ __('Tipe Bangunan Pelimpah') }}</label>

                            <div class="col-md-6">
                                <input id="tipe_bangunan_pelimpah" type="text" class="form-control @error('tipe_bangunan_pelimpah') is-invalid @enderror" name="tipe_bangunan_pelimpah" value="{{$data->tipe_bangunan_pelimpah}}" required autocomplete="tipe_bangunan_pelimpah">

                                @error('tipe_bangunan_pelimpah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lokasi_bangunan_pelimpah" class="col-md-4 col-form-label text-md-end">{{ __('Lokasi Bangunan Pelimpah') }}</label>

                            <div class="col-md-6">
                                <input id="lokasi_bangunan_pelimpah" type="text" class="form-control @error('lokasi_bangunan_pelimpah') is-invalid @enderror" name="lokasi_bangunan_pelimpah" value="{{$data->lokasi_bangunan_pelimpah}}" required autocomplete="lokasi_bangunan_pelimpah">

                                @error('lokasi_bangunan_pelimpah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lebar_bangunan_pelimpah" class="col-md-4 col-form-label text-md-end">{{ __('Lebar Bangunan Pelimpah') }}</label>

                            <div class="col-md-6">
                                <input id="lebar_bangunan_pelimpah" type="text" class="form-control @error('lebar_bangunan_pelimpah') is-invalid @enderror" name="lebar_bangunan_pelimpah" value="{{$data->lebar_bangunan_pelimpah}}" required autocomplete="lebar_bangunan_pelimpah">
                                @error('lebar_bangunan_pelimpah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="elevasi_bangunan_pelimpah" class="col-md-4 col-form-label text-md-end">{{ __('Elevasi Bangunan Pelimpah') }}</label>

                            <div class="col-md-6">
                                <input id="elevasi_bangunan_pelimpah" type="text" class="form-control @error('elevasi_bangunan_pelimpah') is-invalid @enderror" name="elevasi_bangunan_pelimpah" value="{{$data->elevasi_bangunan_pelimpah}}" required autocomplete="elevasi_bangunan_pelimpah">

                                @error('elevasi_bangunan_pelimpah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="debit_inflow_qin_bangunan_pelimpah" class="col-md-4 col-form-label text-md-end">{{ __('Debit Inflow Qin Bangunan Pelimpah') }}</label>

                            <div class="col-md-6">
                                <input id="debit_inflow_qin_bangunan_pelimpah" type="text" class="form-control @error('debit_inflow_qin_bangunan_pelimpah') is-invalid @enderror" name="debit_inflow_qin_bangunan_pelimpah" value="{{$data->debit_inflow_qin_bangunan_pelimpah}}" required autocomplete="debit_inflow_qin_bangunan_pelimpah">

                                @error('debit_inflow_qin_bangunan_pelimpah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="debit_inflow_q1000_bangunan_pelimpah" class="col-md-4 col-form-label text-md-end">{{ __('Debit Inflow Q1000 Bangunan Pelimpah') }}</label>

                            <div class="col-md-6">
                                <input id="debit_inflow_q1000_bangunan_pelimpah" type="text" class="form-control @error('debit_inflow_q1000_bangunan_pelimpah') is-invalid @enderror" name="debit_inflow_q1000_bangunan_pelimpah" value="{{$data->debit_inflow_q1000_bangunan_pelimpah}}" required autocomplete="debit_inflow_q1000_bangunan_pelimpah">

                                @error('debit_inflow_q1000_bangunan_pelimpah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tipe_bangunan_pengambilan" class="col-md-4 col-form-label text-md-end">{{ __('Tipe Bangunan Pengambilan') }}</label>

                            <div class="col-md-6">
                                <input id="tipe_bangunan_pengambilan" type="text" class="form-control @error('tipe_bangunan_pengambilan') is-invalid @enderror" name="tipe_bangunan_pengambilan" value="{{$data->tipe_bangunan_pengambilan}}" required autocomplete="tipe_bangunan_pengambilan">

                                @error('tipe_bangunan_pengambilan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lokasi_bangunan_pengambilan" class="col-md-4 col-form-label text-md-end">{{ __('Lokasi Bangunan Pengambilan') }}</label>

                            <div class="col-md-6">
                                <input id="lokasi_bangunan_pengambilan" type="text" class="form-control @error('lokasi_bangunan_pengambilan') is-invalid @enderror" name="lokasi_bangunan_pengambilan" value="{{$data->lokasi_bangunan_pengambilan}}" required autocomplete="lokasi_bangunan_pengambilan">

                                @error('lokasi_bangunan_pengambilan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="saluran_hantar_bangunan_pengambilan" class="col-md-4 col-form-label text-md-end">{{ __('Saluran Hantar Bangunan Pengambilan') }}</label>

                            <div class="col-md-6">
                                <input id="saluran_hantar_bangunan_pengambilan" type="text" class="form-control @error('saluran_hantar_bangunan_pengambilan') is-invalid @enderror" name="saluran_hantar_bangunan_pengambilan" value="{{$data->saluran_hantar_bangunan_pengambilan}}" required autocomplete="saluran_hantar_bangunan_pengambilan">

                                @error('saluran_hantar_bangunan_pengambilan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="diameter_terowongan_bangunan_pengambilan" class="col-md-4 col-form-label text-md-end">{{ __('Diameter Terowongan Bangunan Pengambilan') }}</label>

                            <div class="col-md-6">
                                <input id="diameter_terowongan_bangunan_pengambilan" type="text" class="form-control @error('diameter_terowongan_bangunan_pengambilan') is-invalid @enderror" name="diameter_terowongan_bangunan_pengambilan" value="{{$data->diameter_terowongan_bangunan_pengambilan}}" required autocomplete="diameter_terowongan_bangunan_pengambilan">

                                @error('diameter_terowongan_bangunan_pengambilan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kapasitas_max_bangunan_pengambilan" class="col-md-4 col-form-label text-md-end">{{ __('Kapasitas Terowongan Bangunan Pengambilan') }}</label>

                            <div class="col-md-6">
                                <input id="kapasitas_max_bangunan_pengambilan" type="text" class="form-control @error('kapasitas_max_bangunan_pengambilan') is-invalid @enderror" name="kapasitas_max_bangunan_pengambilan" value="{{$data->kapasitas_max_bangunan_pengambilan}}" required autocomplete="kapasitas_max_bangunan_pengambilan">
                                @error('kapasitas_max_bangunan_pengambilan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="elev_muka_air_waduk" class="col-md-4 col-form-label text-md-end">{{ __('Elev Muka Air Waduk') }}</label>

                            <div class="col-md-6">
                                <input id="elev_muka_air_waduk" type="text" class="form-control @error('elev_muka_air_waduk') is-invalid @enderror" name="elev_muka_air_waduk" value="{{$data->elev_muka_air_waduk}}" required autocomplete="elev_muka_air_waduk">

                                @error('elev_muka_air_waduk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kapasitas_waduk" class="col-md-4 col-form-label text-md-end">{{ __('Kapasitas Waduk') }}</label>

                            <div class="col-md-6">
                                <input id="kapasitas_waduk" type="text" class="form-control @error('kapasitas_waduk') is-invalid @enderror" name="kapasitas_waduk" value="{{$data->kapasitas_waduk}}" required autocomplete="kapasitas_waduk">

                                @error('kapasitas_waduk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="luas_genangan_waduk" class="col-md-4 col-form-label text-md-end">{{ __('Luas Genangan Waduk') }}</label>

                            <div class="col-md-6">
                                <input id="luas_genangan_waduk" type="text" class="form-control @error('luas_genangan_waduk') is-invalid @enderror" name="luas_genangan_waduk" value="{{$data->luas_genangan_waduk}}" required autocomplete="luas_genangan_waduk">
                                @error('luas_genangan_waduk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Rubah Data') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection