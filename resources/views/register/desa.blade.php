@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tambah Desa</div>

                <div class="card-body">
                    <form action="{{ url('statusbocor/proses') }}" method="post">

                        @csrf
                        <input type="hidden" name="fungsi" value="Tambah">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Kode Desa</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kode_desa" placeholder="Masukkan Kode Desa" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Desa Titik Latitude</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="desa_lat" placeholder="Masukkan Desa Titik Latitude" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Desa Titik Latitude</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="desa_long" placeholder="Masukkan Desa Titik Latitude" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama Kelurahan</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kelurahan_desa" placeholder="Masukkan Nama Kelurahan" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama Kecamatan</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kecamatan_desa" placeholder="Masukkan Nama Kecamatan" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama Kabupaten</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kabupaten_desa" placeholder="Masukkan Nama Kabupaten" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Jarak Dari Bendungan</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="jarak_dari_bendungan" placeholder="Masukkan Jarak Dari Bendungan" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Banjir</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="banjir" placeholder="Masukkan Banjir" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Tinggi Banjir</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="banjir" placeholder="Masukkan Tinggi Banjir" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Kecepatan Maksimal</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kec_max" placeholder="Masukkan Kecepatan Maksimal" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Waktu Tiba</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="waktu_tiba" placeholder="Masukkan Waktu Tiba" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Waktu Surut</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="waktu_surut" placeholder="Masukkan Waktu Surut" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Durasi Banjir</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="durasi_banjir" placeholder="Masukkan Durasi Banjir" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Jumlah Jiwa</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="jumlah_jiwa" placeholder="Masukkan Jumlah Jiwa" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Jumlah KK</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="jumlah_KK" placeholder="Masukkan Jumlah KK" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Affected Rendah</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="rendah" placeholder="Masukkan Affected Rendah" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Affected Sedang</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="sedang" placeholder="Masukkan Affected Sedang" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Affected Tinggi</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="tinggi" placeholder="Masukkan Affected Tinggi" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Affected Total</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="total" placeholder="Masukkan Affected Total" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Affected KK</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kk" placeholder="Masukkan Affected KK" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Tidak Terdampak</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="tidak_terdampak" placeholder="Masukkan Tidak Terdampak" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Zona Bahaya</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="zona_bahaya" placeholder="Masukkan Zona Bahaya" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Balita (0-4 Tahun)</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="balita" placeholder="Masukkan Pengungsi Balita" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Anak-Anak (5-14 Tahun)</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="anak" placeholder="Masukkan Pengungsi Anak-Anak" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Muda (14-24 Tahun)</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="muda" placeholder="Masukkan Pengungsi Muda" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Dewasa (24-64 Tahun)</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="dewasa" placeholder="Masukkan Pengungsi Dewasa" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Manula (>64 Tahun)</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="manula" placeholder="Masukkan Pengungsi Manula" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Total Jiwa</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="total_jiwa" placeholder="Masukkan Total Jiwa" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Laki-Laki</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="laki-laki" placeholder="Masukkan Pengungsi Laki-Laki" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsi Perempuan</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="perempuan" placeholder="Masukkan Pengungsi Perempuan" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Total Laki-laki & Perempuan</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="total_LP" placeholder="Masukkan Total Laki-laki & Perempuan" required>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a class="btn btn-warning" type="reset" href="{{ url()->previous() }}">TUTUP</a>
                                <button type="submit" class="btn btn-success">SIMPAN</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection