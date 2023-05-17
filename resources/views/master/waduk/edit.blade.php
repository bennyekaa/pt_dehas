@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tambah Status Waduk</div>

                    <div class="card-body">
                        <form action="{{ url('waduk/proses') }}" method="post">

                            @csrf
                            <input type="hidden" name="fungsi" value="Edit">
                            <input type="hidden" name="id_waduk" value="{{$riwayat_waduk->id_waduk}}">

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Muka Air</label>
                                <div class="col-md-6">
                                    <input type="number" step="any" class="form-control" name="muka_air" placeholder="Masukkan Nilai Muka Air" required value="{{$riwayat_waduk->muka_air}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Tinggi Air</label>
                                <div class="col-md-6">
                                    <input type="number" step="any" class="form-control" name="tinggi_air" placeholder="Masukkan Nilai Tinggi Air" required value="{{$riwayat_waduk->tinggi_air}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Debit Keluar</label>
                                <div class="col-md-6">
                                    <input type="number" step="any" class="form-control" name="debit_keluar" placeholder="Masukkan Nilai Debit Keluar" required value="{{$riwayat_waduk->debit_keluar}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan</label>
                                <div class="col-md-6">
                                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Masukkan Keterangan">{{$riwayat_waduk->keterangan}}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Status</label>
                                <div class="col-md-6">
                                    <select class="form-control select2" name="status" required>
                                        <option value="">--Masukkan Status--</option>
                                            <option value="0" @if($riwayat_waduk->status == 0) {{'selected'}} @endif>Normal</option>
                                            <option value="1" @if($riwayat_waduk->status == 1) {{'selected'}} @endif>Waspada 1</option>
                                            <option value="2" @if($riwayat_waduk->status == 2) {{'selected'}} @endif>Waspada 2</option>
                                            <option value="3" @if($riwayat_waduk->status == 3) {{'selected'}} @endif>Siaga</option>
                                            <option value="4" @if($riwayat_waduk->status == 4) {{'selected'}} @endif>Awas</option>
                                            <option value="5" @if($riwayat_waduk->status == 5) {{'selected'}} @endif>Bahaya</option>
                                    </select>
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
