@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Kategori</div>

                    <div class="card-body">
                        <form action="{{url('statusbocor/proses')}}" method="post">

                            @csrf
                            <input type="hidden" name="fungsi" value="Edit">
                            <input type="hidden" name="id_status_bocor" value="{{$riwayat_status->id_status_bocor}}">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Kategori Bocor</label>
                                <div class="col-md-6">
                                    <select class="form-control select2" name="id_kategori_bocor" required>
                                        <option value="">--Masukkan Kategori Bocor--</option>
                                        @foreach ($kategoribocor as $item)
                                            <option value="{{ $item->id_kategori_bocor }}" {{($riwayat_status->id_kategori_bocor == $item->id_kategori_bocor) ? 'selected' : ''}}>
                                                {{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Nama Status</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="nama_status" value="{{$riwayat_status->nama_status}}" placeholder="Masukkan Nama Status" required>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan</label>
                                <div class="col-md-6">
                                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Masukkan Keterangan">{{$riwayat_status->keterangan}}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Status</label>
                                <div class="col-md-6">
                                    <select class="form-control select2" name="status" required>
                                        <option value="">--Masukkan Status--</option>
                                            <option value="0" @if ($riwayat_status->status == 0) {{'selected'}}@endif>Normal</option>
                                            <option value="1" @if ($riwayat_status->status == 1) {{'selected'}}@endif>Waspada 1</option>
                                            <option value="2" @if ($riwayat_status->status == 2) {{'selected'}}@endif>Waspada 2</option>
                                            <option value="3" @if ($riwayat_status->status == 3) {{'selected'}}@endif>Siaga</option>
                                            <option value="4" @if ($riwayat_status->status == 4) {{'selected'}}@endif>Bahaya</option>
                                    </select>
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
