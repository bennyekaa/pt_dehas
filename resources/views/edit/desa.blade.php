@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form action="{{url('prosesdesa')}}" method="post">

                        @csrf
                        <input type="hidden" name="id_desa" value="{{$data->id_desa}}">
                        <div class="row mb-3">
                            <label for="kode_pengungsian" class="col-md-4 col-form-label text-md-end">{{ __('Kode Pengungsian') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('kode_pengungsian') is-invalid @enderror" name="kode_pengungsian" value="{{$data->kode_pengungsian}}" required autocomplete="name" autofocus>

                                @error('kode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="desa" class="col-md-4 col-form-label text-md-end">{{ __('Desa') }}</label>

                            <div class="col-md-6">
                                <input id="desa" type="text" class="form-control @error('desa') is-invalid @enderror" name="desa" value="{{$data->desa}}" required autocomplete="name" autofocus>

                                @error('desa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="titik_kumpul" class="col-md-4 col-form-label text-md-end">{{ __('Titik Kumpul') }}</label>

                            <div class="col-md-6">
                                <input id="titik_kumpul" type="text" class="form-control @error('titik_kumpul') is-invalid @enderror" name="titik_kumpul" value="{{$data->titik_kumpul}}" required autocomplete="name" autofocus>

                                @error('titik_kumpul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jarak_tk" class="col-md-4 col-form-label text-md-end">{{ __('Jarak Titik Kumpul') }}</label>

                            <div class="col-md-6">
                                <input id="jarak_tk" type="text" class="form-control @error('jarak_tk') is-invalid @enderror" name="jarak_tk" value="{{$data->jarak_titik_kumpul}}" required autocomplete="email">

                                @error('jarak_tk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tk_x" class="col-md-4 col-form-label text-md-end">{{ __('TK X') }}</label>

                            <div class="col-md-6">
                                <input id="tk_x" type="text" class="form-control @error('tk_x') is-invalid @enderror" name="tk_x" value="{{$data->tk_x}}" required autocomplete="new-tk_x">

                                @error('tk_x')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tk_y" class="col-md-4 col-form-label text-md-end">{{ __('TK Y') }}</label>

                            <div class="col-md-6">
                                <input id="tk_y" type="text" class="form-control @error('tk_y') is-invalid @enderror" name="tk_y" value="{{$data->tk_y}}" required autocomplete="new-tk_y">

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
                                <input id="lokasi_pengungsian" type="text" class="form-control @error('lokasi_pengungsian') is-invalid @enderror" name="lokasi_pengungsian" value="{{$data->lokasi_pengungsian}}" required autocomplete="new-lokasi_pengungsian">

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
                                <input id="jarak_pengungsian" type="text" class="form-control @error('jarak_pengungsian') is-invalid @enderror" name="jarak_pengungsian" value="{{$data->jarak_pengungsian}}" required autocomplete="new-jarak_pengungsian">

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
                                <input id="p_x" type="text" class="form-control @error('p_x') is-invalid @enderror" name="p_x" value="{{$data->p_x}}" required autocomplete="new-p_x">

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
                                <input id="p_y" type="text" class="form-control @error('p_y') is-invalid @enderror" name="p_y" value="{{$data->p_y}}" required autocomplete="new-p_y">

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
                                <input id="e_x" type="text" class="form-control @error('e_x') is-invalid @enderror" name="e_x" value="{{$data->e_x}}" required autocomplete="e_x">

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
                                <input id="e_y" type="text" class="form-control @error('e_y') is-invalid @enderror" name="e_y" value="{{$data->e_y}}" required autocomplete="e_y">

                                @error('e_y')
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