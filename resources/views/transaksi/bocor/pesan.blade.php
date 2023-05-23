@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Masukkan Pesan Notifikasi</div>

                <div class="card-body">
                    <form action="{{ url('transaksi/bocor/notif') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_bocor" value="{{ $id_bocor }}">
                        <input type="hidden" name="role" value="{{ $role }}">
                        <div class="row mb-3">
                            <label for="pesan" class="col-md-4 col-form-label text-md-end">Pesan</label>
                            <div class="col-md-6">
                                <textarea name="pesan" class="form-control" rows="3" placeholder="Masukkan Pesan"></textarea>
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