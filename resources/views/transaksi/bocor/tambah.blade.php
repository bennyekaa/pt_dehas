@extends('layouts.app')
@section('content')

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Banjir</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="/transaksi/bocor/proses" method="post">

                        @csrf

                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" id="kategori" class="form-control col-md-6" required>
                                @foreach ($kategori as $val)
                                <option value="{{ $val->id_kategori_bocor }}">{{ $val->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status Bocor</label>
                            <select name="status_bocor" id="status_bocor" class="form-control col-md-6" required>
                                <option>

                                </option>
                            </select>
                        </div>

                        <div class="row mb-3">
                            <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan Tambahan</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="keterangan" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file">Pilih File</label>
                            <input type="file" class="form-control-file" id="file" name="data_file">
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
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

@section('tambahanjs')
<script type="text/javascript">
    $('#kategori').change(function() {
        var id = $('#kategori').val();
        $.get('{{url('transaksi/bocor/get_status')}}/'+id,
            function(data) {
                $('#status_bocor').empty();
                $('#status_bocor').append("<option value='0'>Pilih</option>");
                $.each(data, function(index, element) {
                    var no = 0;
                    $('#status_bocor').append("<option value='" + element.id_status_bocor + "'>" + element.nama_status + "</option>");
                });
            });
    });
</script>
@endsection