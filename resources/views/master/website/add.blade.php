@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Website</div>

                    <div class="card-body">
                        <form action="{{url('web/proses')}}" method="post">

                            @csrf
                            <input type="hidden" name="fungsi" value="Tambah">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Nama Website</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="nama_web" placeholder="Masukkan Nama Website" required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="url_web" class="col-md-4 col-form-label text-md-end">Url Website</label>

                                <div class="col-md-6">
                                    <input id="url_web" type="text" class="form-control" name="url_web" placeholder="Masukkan Url Website" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="keterangan"
                                    class="col-md-4 col-form-label text-md-end">Keterangan</label>

                                <div class="col-md-6">
                                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Masukkan Keterangan"></textarea>
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
