@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{('Register') }}</div>

                <div class="card-body">
                    <form action="/user/store" method="post">

                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{('Nama')}}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nama" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{('Username')}}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="username" value="{{ old('username') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{('No HP')}}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="no_hp" value="{{ old('no_hp') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{('Alamat Email')}}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{('Password')}}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Jabatan</label>
                            <div class="col-md-6">
                                <select class="form-control select2" name="id_role" required>
                                    <option value="">--Masukkan Jabatan--</option>
                                    @foreach ($jabatan as $item)
                                    <option value="{{ $item->id_role }}">
                                        {{ $item->nama_role }}
                                    </option>
                                    @endforeach
                                </select>
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