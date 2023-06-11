@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rubah Data Pengungsian</div>

                <div class="card-body">
                    <form action="{{url('prosespengungsian')}}" method="post">

                        @csrf
                        <input type="hidden" name="fungsi" value="Edit">
                        <input type="hidden" name="id_pengungsian" value="{{$pengungsian->id_pengungsian}}">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Kode Pengungsian</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kode_pengungsian" value="{{$pengungsian->kode_pengungsian}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsian Latitude</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="pengungsian_lat" value="{{$pengungsian->pengungsian_lat}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Pengungsian Longitude</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="pengungsian_long" value="{{$pengungsian->pengungsian_long}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama Pengungsian</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nama_pengungsian" value="{{$pengungsian->nama_pengungsian}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama Desa Pengungsian</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nama_desa_pengungsian" value="{{$pengungsian->nama_desa_pengungsian}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama Kecamatan Pengungsian</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nama_kecamatan_pengungsian" value="{{$pengungsian->nama_kecamatan_pengungsian}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama Kabupaten Pengungsian</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nama_kabupaten_pengungsian" value="{{$pengungsian->nama_kabupaten_pengungsian}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Jarak Pengungsian</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="jarak_pengungsian" value="{{$pengungsian->jarak_pengungsian}}" required autofocus>
                            </div>
                        </div>


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