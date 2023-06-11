@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rubah Data Titik Kumpul</div>

                <div class="card-body">
                    <form action="{{url('prosestitikkumpul')}}" method="post">

                        @csrf
                        <input type="hidden" name="fungsi" value="Edit">
                        <input type="hidden" name="id_titik_kumpul" value="{{$titikkumpul->id_titik_kumpul}}">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Kode Titik Kumpul</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="kode_tk" value="{{$titikkumpul->kode_tk}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Titik Kumpul Latitude</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="tk_lat" value="{{$titikkumpul->tk_lat}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Titik Kumpul Longitude</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="tk_long" value="{{$titikkumpul->tk_long}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama Titik Kumpul</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nama_titik_kumpul" value="{{$titikkumpul->nama_titik_kumpul}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Desa</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nama_desa" value="{{$titikkumpul->nama_desa}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Kecamatan</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nama_kecamatan" value="{{$titikkumpul->nama_kecamatan}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Kabupaten</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nama_kabupaten" value="{{$titikkumpul->nama_kabupaten}}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Jarak Ke Titik Kumpul</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="jarak_ke_tk" value="{{$titikkumpul->jarak_ke_tk}}" required autofocus>
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