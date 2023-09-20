@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Laporan</div>

                    <div class="card-body">

                            {{-- @csrf --}}
                            {{-- <input type="hidden" name="id_user" value="{{$user->id_user}}"> --}}
                            {{-- <input type="hidden" name="fungsi" value="Edit"> --}}
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Tanggal Mulai</label>
                                <div class="col-md-6">
                                <input id="mulai" type="text" class="form-control datepicker" name="mulai"
                                        placeholder="Klik Disini" readonly required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Tanggal Selesai</label>
                                <div class="col-md-6">
                                <input id="selesai" type="text" class="form-control datepicker" name="selesai"
                                        placeholder="Klik Disini" readonly>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a class="btn btn-warning" type="reset" href="{{ url()->previous() }}">KEMBALI</a>
                                    <a href="{{url('laporan/export')}}" class="btn btn-success">EXPORT</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
