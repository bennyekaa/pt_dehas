@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Device</div>

                    <div class="card-body">
                        <form action="{{ url('device/proses') }}" method="post">

                            @csrf
                            <input type="hidden" name="id_user" value="{{$user->id_user}}">
                            <input type="hidden" name="fungsi" value="Edit">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Jumlah Device</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="total_device"
                                        placeholder="Masukkan Jumlah Device" required autofocus value="{{$user->total_device}}">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a class="btn btn-warning" type="reset" href="{{ url()->previous() }}">TUTUP</a>
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
