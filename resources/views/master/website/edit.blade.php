@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Website</div>

                    <div class="card-body">
                        <form action="{{url('web/proses')}}" method="post">

                            @csrf
                            <input type="hidden" name="fungsi" value="Edit">
                            <input type="hidden" name="id_web" value="{{$riwayat_web->id_web}}">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Nama Website</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="nama_web" placeholder="Masukkan Nama Website" value="{{$riwayat_web->nama_web}}" required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="url_web" class="col-md-4 col-form-label text-md-end">Url Website</label>

                                <div class="col-md-6">
                                    <input id="url_web" type="text" class="form-control" name="url_web" placeholder="Masukkan Url Website" value="{{$riwayat_web->url_web}}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="keterangan"
                                    class="col-md-4 col-form-label text-md-end">Keterangan</label>

                                <div class="col-md-6">
                                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Masukkan Keterangan">{{$riwayat_web->keterangan}}</textarea>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a class="btn btn-warning" type="reset" href="{{url()->previous()}}">TUTUP</a>
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
