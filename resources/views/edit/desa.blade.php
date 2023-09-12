@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rubah Data Desa</div>

                <div class="card-body">
                    <form action="{{url('prosesdesa')}}" method="post">

                        @csrf
                        <input type="hidden" name="fungsi" value="Edit">
                        <input type="hidden" name="id_desa" value="{{$desa->id_desa}}">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Kode Desa</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kode_desa" placeholder="Kode Desa" value="{{$desa->kode_desa}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Desa Latitude</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="desa_lat" placeholder="Desa Latitude" value="{{$desa->desa_lat}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Desa Longtitude</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="desa_long" placeholder="Desa Longtitude" value="{{$desa->desa_long}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Radius</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="radius" placeholder="Radius" value="{{$desa->radius}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Kelurahan</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kelurahan_desa" placeholder="Kelurahan" value="{{$desa->kelurahan_desa}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Kecamatan</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kecamatan_desa" placeholder="kecamatan" value="{{$desa->kecamatan_desa}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Kabupaten</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kabupaten_desa" placeholder="Kabupaten" value="{{$desa->kabupaten_desa}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Jarak Dari Bendungan</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="jarak_dari_bendungan" placeholder="Jarak Dari Bendungan" value="{{$desa->jarak_dari_bendungan}}" required autofocus>
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Tinggi Banjir</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="banjir" placeholder="Tinggi Banjir" value="{{$desa->banjir}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Kecapatan Maksimal</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kec_max" placeholder="Kecepatan Maksimal" value="{{$desa->kec_max}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Waktu Tiba</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="waktu_tiba" placeholder="Waktu Tiba" value="{{$desa->waktu_tiba}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Waktu Surut</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="waktu_surut" placeholder="Waktu Surut" value="{{$desa->waktu_surut}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Durasi Banjir</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="durasi_banjir" placeholder="Durasi Banjir" value="{{$desa->durasi_banjir}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Jumlah Jiwa</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="jumlah_jiwa" placeholder="Jumlah Jiwa" value="{{$desa->jumlah_jiwa}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Jumlah KK</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="jumlah_kk" placeholder="Jumlah KK" value="{{$desa->jumlah_kk}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Terdampak Rendah</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="rendah" placeholder="Terdampak Rendah" value="{{$desa->rendah}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Terdampak Sedang</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="sedang" placeholder="Terdampak Sedang" value="{{$desa->sedang}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Terdampak Tinggi</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="tinggi" placeholder="Terdampak Tinggi" value="{{$desa->tinggi}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Total Terdampak</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="total" placeholder="Total Terdampak" value="{{$desa->total}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Total KK</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kk" placeholder="Total KK" value="{{$desa->kk}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Tidak Terdampak</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="tidak_terdampak" placeholder="Tidak Terdampak" value="{{$desa->tidak_terdampak}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Zona Bahaya</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="zona_bahaya" placeholder="Zona Bahaya" value="{{$desa->zona_bahaya}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Balita (0-4th)</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="balita" placeholder="Pengungsi Balita (0-4th)" value="{{$desa->balita}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Anak (5-14th)</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="anak" placeholder="Pengungsi Anak (5-14th)" value="{{$desa->anak}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Muda (14-24th)</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="muda" placeholder="Pengungsi Muda (14-24th)" value="{{$desa->muda}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Dewasa (25-64th)</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="dewasa" placeholder="Pengungsi Dewasa (25-64th)" value="{{$desa->dewasa}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Manula (>64th)</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="manula" placeholder="Pengungsi Manula (>64th)" value="{{$desa->manula}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Total</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="total_jiwa" placeholder="Total" value="{{$desa->total_jiwa}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Laki-Laki</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="laki_laki" placeholder="Pengungsi Laki-Laki" value="{{$desa->laki_laki}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Perempuan</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="perempuan" placeholder="Pengungsi Perempuan" value="{{$desa->perempuan}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Total L&P</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="total_LP" placeholder="Total L&P" value="{{$desa->total_LP}}" required autofocus>
                            </div>
                        </div> --}}

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ ('Rubah Data') }}
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
