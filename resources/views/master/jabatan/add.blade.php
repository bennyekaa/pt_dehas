@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tambah Jabatan</div>

                <div class="card-body">
                    <form action="{{url('jabatan/tambahproses')}}" method="post">

                        @csrf
                        <input type="hidden" name="fungsi" value="Tambah">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama Jabatan</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nama_role" placeholder="Masukkan Nama Jabatan" required autofocus>
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