@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{('Tambah Desa ')}}</div>

                <div class="card-body">
                    <form action="/desa/tambahproses" method="post">

                        @csrf

                        <div class="row mb-3">
                            <label for="kode_pengungsian" class="col-md-4 col-form-label text-md-end">{{ ('Kode Pengungsian') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('kode_pengungsian') is-invalid @enderror" name="kode_pengungsian" value="{{ old('kode_pengungsian') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="desa" class="col-md-4 col-form-label text-md-end">{{ __('Desa') }}</label>

                            <div class="col-md-6">
                                <input id="desa" type="text" class="form-control @error('desa') is-invalid @enderror" name="desa" value="{{ old('desa') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="titik_kumpul" class="col-md-4 col-form-label text-md-end">{{ __('Titik Kumpul') }}</label>

                            <div class="col-md-6">
                                <input id="titik_kumpul" type="text" class="form-control @error('titik_kumpul') is-invalid @enderror" name="titik_kumpul" value="{{ old('titik_kumpul') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jarak_tk" class="col-md-4 col-form-label text-md-end">{{ __('Jarak Titik Kumpul') }}</label>

                            <div class="col-md-6">
                                <input id="jarak_tk" type="text" class="form-control @error('jarak_tk') is-invalid @enderror" name="jarak_tk" value="{{ old('jarak_tk') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tk_long" class="col-md-4 col-form-label text-md-end">{{ __('Titik Kumpul Longitude') }}</label>

                            <div class="col-md-6">
                                <input id="tk_long" type="text" class="form-control @error('tk_long') is-invalid @enderror" name="tk_long" required autocomplete="new-tk_long">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tk_lat" class="col-md-4 col-form-label text-md-end">{{ __('Titik Latitude') }}</label>

                            <div class="col-md-6">
                                <input id="tk_lat" type="text" class="form-control @error('tk_lat') is-invalid @enderror" name="tk_lat" required autocomplete="new-tk_lat">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lokasi_pengungsian" class="col-md-4 col-form-label text-md-end">{{ __('Lokasi Pengungsian') }}</label>

                            <div class="col-md-6">
                                <input id="lokasi_pengungsian" type="text" class="form-control @error('lokasi_pengungsian') is-invalid @enderror" name="lokasi_pengungsian" required autocomplete="new-lokasi_pengungsian">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jarak_pengungsian" class="col-md-4 col-form-label text-md-end">{{ __('Jarak Pengungsian') }}</label>

                            <div class="col-md-6">
                                <input id="jarak_pengungsian" type="text" class="form-control @error('jarak_pengungsian') is-invalid @enderror" name="jarak_pengungsian" required autocomplete="new-jarak_pengungsian">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="p_long" class="col-md-4 col-form-label text-md-end">{{ __('Pengungsian Longitude') }}</label>

                            <div class="col-md-6">
                                <input id="p_long" type="text" class="form-control @error('p_long') is-invalid @enderror" name="p_long" required autocomplete="new-p_long">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="p_lat" class="col-md-4 col-form-label text-md-end">{{ __('Pengungsian Latitude') }}</label>

                            <div class="col-md-6">
                                <input id="p_lat" type="text" class="form-control @error('p_lat') is-invalid @enderror" name="p_lat" required autocomplete="new-p_lat">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="e_long" class="col-md-4 col-form-label text-md-end">{{ __('Evakuasi Longitude') }}</label>

                            <div class="col-md-6">
                                <input id="e_long" type="text" class="form-control @error('e_long') is-invalid @enderror" name="e_long" required autocomplete="e_long">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="e_lat" class="col-md-4 col-form-label text-md-end">{{ __('Evakuasi Latitude') }}</label>

                            <div class="col-md-6">
                                <input id="e_lat" type="text" class="form-control @error('e_lat') is-invalid @enderror" name="e_lat" required autocomplete="e_lat">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tambah') }}
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