@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Masukkan Ketinggian Muka Air</div>

                    <div class="card-body">
                        <form action="{{ url('transaksi/mukaair/proses') }}" method="post">
                            @csrf
                            <input type="hidden" name="fungsi" value="Tambah">
                            <div class="row mb-3">
                                <label for="tinggi_air" class="col-md-4 col-form-label text-md-end">Muka Air</label>
                                <div class="col-md-6">
                                    <input type="number" step="any" name="tinggi_air" placeholder="Masukkan Tinggi Air" autofocus>
                                    {{-- <select class="form-control select2" name="id_waduk" id="list_mukaair">
                                        <option value="">--Masukkan Muka Air--</option>
                                        @foreach ($mukaair as $item)
                                            <option value="{{ $item->id_waduk }}">
                                                {{ $item->muka_air }}</option>
                                        @endforeach
                                    </select> --}}
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
@section('tambahanjs')
    <script type="text/javascript">
        // $(document).ready(function() {
        //     $("#list_mukaair").select2({
        //         tags: true,
        //         maximumInputLength: 7
        //     });
        // });
    </script>
@endsection
