@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form action="{{url('proseswaduk')}}" method="post">

                        @csrf
                        <input type="hidden" name="id_waduk" value="{{$data->id_waduk}}">

                        <div class="row mb-3">
                            <label for="Batas_Atas_Muka_air" class="col-md-4 col-form-label text-md-end">{{ __('Batas_Atas_Muka_air') }}</label>

                            <div class="col-md-6">
                                <input id="Batas_Atas_Muka_air" type="text" class="form-control @error('Batas_Atas_Muka_air') is-invalid @enderror" name="Batas_Atas_Muka_air" value="{{$data->batas_atas_muka_air}}" required autocomplete="name" autofocus>

                                @error('Batas_Atas_Muka_air')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Batas_Bawah_Muka_air" class="col-md-4 col-form-label text-md-end">{{ __('Batas_Bawah_Muka_air') }}</label>

                            <div class="col-md-6">
                                <input id="Batas_Bawah_Muka_air" type="text" class="form-control @error('Batas_Bawah_Muka_air') is-invalid @enderror" name="Batas_Bawah_Muka_air" value="{{$data->batas_bawah_muka_air}}" required autocomplete="name" autofocus>

                                @error('Batas_Bawah_Muka_air')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Muka_air" class="col-md-4 col-form-label text-md-end">{{ __('Muka_air') }}</label>

                            <div class="col-md-6">
                                <input id="Muka_air" type="text" class="form-control @error('Muka_air') is-invalid @enderror" name="Muka_air" value="{{$data->muka_air}}" required autocomplete="name" autofocus>

                                @error('Muka_air')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="desa" class="col-md-4 col-form-label text-md-end">{{ __('Tinggi_air') }}</label>

                            <div class="col-md-6">
                                <input id="Tinggi_air" type="text" class="form-control @error('Tinggi_air') is-invalid @enderror" name="Tinggi_air" value="{{$data->tinggi_air}}" required autocomplete="name" autofocus>

                                @error('Tinggi_air')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Debit_keluar" class="col-md-4 col-form-label text-md-end">{{ __('Debit_keluar') }}</label>

                            <div class="col-md-6">
                                <input id="Debit_kelua" type="text" class="form-control @error('Debit_keluar') is-invalid @enderror" name="Debit_keluar" value="{{$data->debit_keluar}}" required autocomplete="name" autofocus>

                                @error('Debit_keluar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('status') }}</label>

                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{$data->status}}" required autocomplete="email">

                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Keterangan" class="col-md-4 col-form-label text-md-end">{{ __('Keterangan') }}</label>

                            <div class="col-md-6">
                                <input id="Keterangan" type="text" class="form-control @error('Keterangan') is-invalid @enderror" name="keterangan" value="{{$data->keterangan}}" required autocomplete="new-keterangan">

                                @error('Keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Rubah Data') }}
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