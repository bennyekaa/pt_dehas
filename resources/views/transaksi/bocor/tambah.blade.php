@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Masukkan Kategori Bocor Bendungan</div>
                <div class="card-body">
                    <form action="/transaksi/bocor/proses" method="post" enctype="multipart/form-data">

                        @csrf

                        <div class="row mb-3">
                            <label for="kategori" class="col-md-4 col-form-label text-md-end">Kategori Bocor</label>
                            <div class="col-md-12">
                                <select name="kategori" id="kategori" class="form-control col-md-6 select2">
                                    <option value="">--Pilih Kategori Bocor--</option>
                                    @foreach ($kategori as $val)
                                    <option value="{{ $val->id_kategori_bocor }}">{{ $val->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3" id="div_didih" style="display: none">
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Lokasi Didih Pasir</label>
                                <div class="col-md-8">
                                    <input type="text" name="didihlokasi" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Ukuran</label>
                                <div class="col-md-8">
                                    <input type="text" name="ukuran" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="file" name="didihupload" class="col-md-4 col-form-label text-md-end">Pilih File</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control-file mb-3" name="didih_data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="didih_data_file2" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="didih_data_file3" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="didih_data_file4" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="didih_data_file5" accept="image/*" onchange="return fileValidation()">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="didihketerangan"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3" id="div_gempa" style="display: none">
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Lokasi Gempa</label>
                                <div class="col-md-8">
                                    <input type="text" name="gempalokasi" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Kekuatan</label>
                                <div class="col-md-8">
                                    <input type="text" name="kekuatan" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="file" name="gempaupload" class="col-md-4 col-form-label text-md-end">Pilih File</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control-file mb-3" name="gempa_data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="gempa_data_file2" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="gempa_data_file3" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="gempa_data_file4" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="gempa_data_file5" accept="image/*" onchange="return fileValidation()">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="gempaketerangan"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="div_badai" style="display: none">
                            <div class="col-md-12">
                                <label class="col-md-5 col-form-label text-md-end">TINGGI MAW DARI MERCU PELIMPAH (Meter)</label>
                                <div class="col-md-8">
                                    <input type="text" name="tinggi_MAW" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="file" name="badaiupload" class="col-md-4 col-form-label text-md-end">Pilih File</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control-file mb-3" name="badai_data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="badai_data_file2" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="badai_data_file3" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="badai_data_file4" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="badai_data_file5" accept="image/*" onchange="return fileValidation()">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="badaiketerangan"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="div_longsor" style="display: none">
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Lokasi</label>
                                <div class="col-md-8">
                                    <input type="text" name="longsorlokasi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Panjang</label>
                                <div class="col-md-8">
                                    <input type="text" name="longsorpanjang" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Labar</label>
                                <div class="col-md-8">
                                    <input type="text" name="longsorlebar" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="file" name="longsorupload" class="col-md-4 col-form-label text-md-end">Pilih File</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control-file mb-3" name="longsor_data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="longsor_data_file2" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="longsor_data_file3" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="longsor_data_file4" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="longsor_data_file5" accept="image/*" onchange="return fileValidation()">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="longsorketerangan"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="div_lubang" style="display: none">
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Lokasi</label>
                                <div class="col-md-8">
                                    <input type="text" name="lubanglokasi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Diameter</label>
                                <div class="col-md-8">
                                    <input type="text" name="lubangdiameter" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="file" name="lubangupload" class="col-md-4 col-form-label text-md-end">Pilih File</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control-file mb-3" name="lubang_data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="lubang_data_file2" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="lubang_data_file3" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="lubang_data_file4" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="lubang_data_file5" accept="image/*" onchange="return fileValidation()">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="lubangketerangan"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="div_penurunan" style="display: none">
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Lokasi</label>
                                <div class="col-md-8">
                                    <input type="text" name="penurunanlokasi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Tinggi</label>
                                <div class="col-md-8">
                                    <input type="text" name="penurunantinggi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Panjang</label>
                                <div class="col-md-8">
                                    <input type="text" name="penurunanpanjang" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Lebar</label>
                                <div class="col-md-8">
                                    <input type="text" name="penurunanlebar" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="file" name="penurunanupload" class="col-md-4 col-form-label text-md-end">Pilih File</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control-file mb-3" name="penurunan_data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="penurunan_data_file2" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="penurunan_data_file3" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="penurunan_data_file4" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="penurunan_data_file5" accept="image/*" onchange="return fileValidation()">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="penurunanketerangan"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="div_pusaran" style="display: none">
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Lokasi</label>
                                <div class="col-md-8">
                                    <input type="text" name="pusaranlokasi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Diameter</label>
                                <div class="col-md-8">
                                    <input type="text" name="pusarandiameter" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="file" name="pusaranupload" class="col-md-4 col-form-label text-md-end">Pilih File</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control-file mb-3" name="pusaran_data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="pusaran_data_file2" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="pusaran_data_file3" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="pusaran_data_file4" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="pusaran_data_file5" accept="image/*" onchange="return fileValidation()">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="pusaranketerangan"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="div_rembesan" style="display: none">
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Lokasi</label>
                                <div class="col-md-8">
                                    <input type="text" name="rembesanlokasi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Debit</label>
                                <div class="col-md-8">
                                    <input type="text" name="debit" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="file" name="rembesanupload" class="col-md-4 col-form-label text-md-end">Pilih File</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control-file mb-3" name="rembesan_data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="rembesan_data_file2" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="rembesan_data_file3" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="rembesan_data_file4" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="rembesan_data_file5" accept="image/*" onchange="return fileValidation()">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="rembesanketerangan"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="div_retakan" style="display: none">
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Lokasi</label>
                                <div class="col-md-8">
                                    <input type="text" name="retakanlokasi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Panjang</label>
                                <div class="col-md-8">
                                    <input type="text" name="retakanpanjang" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">

                                <label class="col-md-4 col-form-label text-md-end">Lebar</label>
                                <div class="col-md-8">
                                    <input type="text" name="retakanlebar" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="file" name="rentakanupload" class="col-md-4 col-form-label text-md-end">Pilih File</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control-file mb-3" name="retakan_data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="retakan_data_file2" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="retakan_data_file3" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="retakan_data_file4" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="retakan_data_file5" accept="image/*" onchange="return fileValidation()">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="retakanketerangan"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3" id="div_pergerakan" style="display: none">
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Lokasi</label>
                                <div class="col-md-8">
                                    <input type="text" name="pergerakanlokasi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Panjang</label>
                                <div class="col-md-8">
                                    <input type="text" name="pergerakanpanjang" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="col-md-4 col-form-label text-md-end">Lebar</label>
                                <div class="col-md-8">
                                    <input type="text" name="pergerakanlebar" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="file" name="pergerakanupload" class="col-md-4 col-form-label text-md-end">Pilih File</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control-file mb-3" name="pergerakan_data_file" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="pergerakan_data_file2" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="pergerakan_data_file3" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="pergerakan_data_file4" accept="image/*" onchange="return fileValidation()">
                                    <input type="file" class="form-control-file mb-3" name="pergerakan_data_file5" accept="image/*" onchange="return fileValidation()">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="pergerakanketerangan"></textarea>
                                </div>
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

    function fileValidation2() {
        var fileInput =
            document.getElementById('data_file2');

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

    function fileValidation3() {
        var fileInput =
            document.getElementById('data_file3');

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

    function fileValidation4() {
        var fileInput =
            document.getElementById('data_file4');

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

    function fileValidation5() {
        var fileInput =
            document.getElementById('data_file5');

        var filePath = fileInput.value;

        // Allowing file type
        var allowedExtensions =
            /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        if (!allowedExtensions.exec(filePath)) {
            alert('Type File tidak sesuai!');
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
        var nama = $('#kategori :selected').html();

        $('#div_didih').hide();
        $('#div_gempa').hide();
        $('#div_badai').hide();
        $('#div_longsor').hide();
        $('#div_lubang').hide();
        $('#div_penurunan').hide();
        $('#div_pusaran').hide();
        $('#div_rembesan').hide();
        $('#div_retakan').hide();
        $('#div_pergerakan').hide();


        if (nama.trim() == 'DIDIH PASIR') {
            console.log('a');
            $('#div_didih').show();
        }
        if (nama.trim() == 'GEMPA BUMI') {
            console.log('a');
            $('#div_gempa').show();
        }
        if (nama.trim() == 'HUJAN BADAI DENGAN INTENSITAS TINGGI') {
            console.log('a');
            $('#div_badai').show();
        }
        if (nama.trim() == 'LONGSOR ATAU EROSI BESAR PADA TUBUH BENDUNGAN') {
            console.log('a');
            $('#div_longsor').show();
        }
        if (nama.trim() == 'LUBANG BENAM') {
            console.log('a');
            $('#div_lubang').show();
        }
        if (nama.trim() == 'PENURUNAN (SETTLEMENT)') {
            console.log('a');
            $('#div_penurunan').show();
        }
        if (nama.trim() == 'PUSARAN AIR DI HULU') {
            console.log('a');
            $('#div_pusaran').show();
        }
        if (nama.trim() == 'REMBESAN') {
            console.log('a');
            $('#div_rembesan').show();
        }
        if (nama.trim() == 'RETAK PADA TUBUH BENDUNGAN') {
            console.log('a');
            $('#div_retakan').show();
        }
        if (nama.trim() == 'RETAKAN ATAU PERGERAKAN PADA STRUKTUR BETON') {
            console.log('a');
            $('#div_pergerakan').show();
        }

    });
    $('#kategori').trigger('change');
</script>


@endsection