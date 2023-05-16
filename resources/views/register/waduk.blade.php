@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form action="/tambahproses" method="post">

                        @csrf

                        <div class="row mb-3">
                            <label for="Batas_Atas_Muka_Air" class="col-md-4 col-form-label text-md-end">{{ __('Batas atas muka air') }}</label>

                            <div class="col-md-6">
                                <input id="name" type=decimal class="form-control @error('Batas_Atas_Muka_air') is-invalid @enderror" name="Batas_Atas_Muka_air" value="{{ old('Batas_Atas_Muka_air') }}" required autocomplete="name" autofocus>

                                @error('Batas Atas Muka Air')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Batas_Bawah_Muka_Air" class="col-md-4 col-form-label text-md-end">{{ __('Batas bawah muka air') }}</label>

                            <div class="col-md-6">
                                <input id="name" type=decimal class="form-control @error('Batas_Bawah_Muka_air') is-invalid @enderror" name="Batas_Bawah_Muka_air" value="{{ old('Batas_Bawah_Muka_air') }}" required autocomplete="name" autofocus>

                                @error('Batas Bawah Muka Air')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="Muka_air" class="col-md-4 col-form-label text-md-end">{{ __('Muka air') }}</label>

                            <div class="col-md-6">
                                <input id="name" type=decimal class="form-control @error('Muka_air') is-invalid @enderror" name="Muka_air" value="{{ old('Muka_air') }}" required autocomplete="name" autofocus>

                                @error('Muka')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Tinggi_air" class="col-md-4 col-form-label text-md-end">{{ __('Tinggi Air') }}</label>

                            <div class="col-md-6">
                                <input id="Tinggi_air" type=decimal class="form-control @error('Tinggi_air') is-invalid @enderror" name="Tinggi_air" value="{{ old('Tinggi_air') }}" required autocomplete="name" autofocus>

                                @error('Tinggi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Debit_keluar" class="col-md-4 col-form-label text-md-end">{{ __('Debit Keluar') }}</label>

                            <div class="col-md-6">
                                <input id="Debit_keluar" type=decimal class="form-control @error('Debit_keluar') is-invalid @enderror" name="Debit_keluar" value="{{ old('Debit_keluar') }}" required autocomplete="name" autofocus>

                                @error('Debit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jarak_tk" class="col-md-4 col-form-label text-md-end">{{ __('status') }}</label>

                            <div class="col-md-6">
                                <input id="status" type=integer class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('jarak_tk') }}" required autocomplete="email">

                                @error('Status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Keterangan" class="col-md-4 col-form-label text-md-end">{{ __('Keterangan') }}</label>

                            <div class="col-md-6">
                                <input id="Keterangan" type="text" class="form-control @error('Keterangan') is-invalid @enderror" name="keterangan" required autocomplete="new-Keterangan">

                                @error('Keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="row mb-3">
                            <label for="tk_y" class="col-md-4 col-form-label text-md-end">{{ __('Keterangan') }}</label>

                            <div class="col-md-6">
                                <input id="tk_y" type="text" class="form-control @error('tk_y') is-invalid @enderror" name="tk_y" required autocomplete="new-tk_y">

                                @error('tk_y')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lokasi_pengungsian" class="col-md-4 col-form-label text-md-end">{{ __('Lokasi Pengungsian') }}</label>

                            <div class="col-md-6">
                                <input id="lokasi_pengungsian" type="text" class="form-control @error('lokasi_pengungsian') is-invalid @enderror" name="lokasi_pengungsian" required autocomplete="new-lokasi_pengungsian">

                                @error('lokasi_pengungsian')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jarak_pengungsian" class="col-md-4 col-form-label text-md-end">{{ __('Jarak Pengungsian') }}</label>

                            <div class="col-md-6">
                                <input id="jarak_pengungsian" type="text" class="form-control @error('jarak_pengungsian') is-invalid @enderror" name="jarak_pengungsian" required autocomplete="new-jarak_pengungsian">

                                @error('jarak_pengungsian')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="p_x" class="col-md-4 col-form-label text-md-end">{{ __('PX') }}</label>

                            <div class="col-md-6">
                                <input id="p_x" type="text" class="form-control @error('p_x') is-invalid @enderror" name="p_x" required autocomplete="new-p_x">

                                @error('p_x')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="p_y" class="col-md-4 col-form-label text-md-end">{{ __('PY') }}</label>

                            <div class="col-md-6">
                                <input id="p_y" type="text" class="form-control @error('p_y') is-invalid @enderror" name="p_y" required autocomplete="new-p_y">

                                @error('p_y')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="e_x" class="col-md-4 col-form-label text-md-end">{{ __('EX') }}</label>

                            <div class="col-md-6">
                                <input id="e_x" type="text" class="form-control @error('e_x') is-invalid @enderror" name="e_x" required autocomplete="e_x">

                                @error('e_x')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="e_y" class="col-md-4 col-form-label text-md-end">{{ __('EY') }}</label>

                            <div class="col-md-6">
                                <input id="e_y" type="text" class="form-control @error('e_y') is-invalid @enderror" name="e_y" required autocomplete="e_y">

                                @error('e_y')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> -->

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