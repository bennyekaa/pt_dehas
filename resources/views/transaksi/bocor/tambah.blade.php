@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Masukkan Status Bocor Bendungan</div>
                <div class="card-body">
                    <form action="/transaksi/bocor/proses" method="post" enctype="multipart/form-data">

                        @csrf

                        <!-- <div class="row mb-3">
                            <label for="kategori" class="col-md-4 col-form-label text-md-end">Status Bocor</label>
                            <div class="col-md-6">
                                <select name="kategori" id="kategori" class="form-control col-md-6 select2" required>
                                    <option value="">--Pilih Status Bocor--</option>
                                    @foreach ($kategori as $val)
                                    <option value="{{ $val->id_kategori_bocor }}">{{ $val->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Status Bocor</label>
                            <div class="col-md-6">
                                <select name="pilihan" id="pilihan" class="form-control col-md-6" required>
                                    <option value="-">-</option>
                                    <option value="didih">DIDIH PASIR</option>
                                    <option value="gempa">GEMPA BUMI</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3" id="didih" style="display: none">
                            <label class="col-md-4 col-form-label text-md-end">Lokasi</label>
                            <div class="col-md-6">
                                <input type="text" id="lokasi" name="lokasi" class="form-control col-md-6" required>
                            </div>

                            <label class="col-md-4 col-form-label text-md-end">Ukuran</label>
                            <div class="col-md-6">
                                <input type="text" id="ukuran" name="ukuran" class="form-control col-md-6" required>
                            </div>

                            <div class="row mb-3">
                                <label for="file" class="col-md-4 col-form-label text-md-end">Pilih File</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control-file" id="data_file" name="data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file" id="data_file" name="data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file" id="data_file" name="data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file" id="data_file" name="data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file" id="data_file" name="data_file" accept="image/*" onchange="return fileValidation()">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="gempa" style="display: none">
                            <label class="col-md-4 col-form-label text-md-end">Lokasi</label>
                            <div class="col-md-6">
                                <input type="text" id="lokasi" name="lokasi" class="form-control col-md-6" required>
                            </div>

                            <label class="col-md-4 col-form-label text-md-end">Kekuatan</label>
                            <div class="col-md-6">
                                <input type="text" id="kekuatan" name="kekuatan" class="form-control col-md-6" required>
                            </div>

                            <div class="row mb-3">
                                <label for="file" class="col-md-4 col-form-label text-md-end">Pilih File</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control-file" id="data_file" name="data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file" id="data_file" name="data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file" id="data_file" name="data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file" id="data_file" name="data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file" id="data_file" name="data_file" accept="image/*" onchange="return fileValidation()">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan Tambahan</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                            </div>
                        </div>

                        <div class=" row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{('Simpan')}}
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
    document.getElementById('pilihan').onchange = function() {
        if (this.value == 'didih') {
            document.getElementById('didih').style.display = 'block';
        } else {
            document.getElementById('didih').style.display = 'none';
        }
        if (this.value == 'gempa') {
            document.getElementById('gempa').style.display = 'block';
        } else {
            document.getElementById('gempa').style.display = 'none';
        }
    };
</script>

<script type="text/javascript">
    function fileValidation() {
        var fileInput =
            document.getElementById('data_file');

        var filePath = fileInput.value;

        // Allowing file type
        var allowedExtensions =
            /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        if (!allowedExtensions.exec(filePath)) {
            alert('Type File tidak sesuai!!!');
            fileInput.value = '';
            return false;
        } else {
            // Image preview
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(
                            'imagePreview').innerHTML =
                        '<img src="' + e.target.result +
                        '"/>';
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    };

    $('#kategori').change(function() {
        var id = $('#kategori').val();
        console.log(id);
        $.get('{{url('
            transaksi / bocor / get_status ')}}/' + id,
            function(data) {
                console.log(data);
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