@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Upload Berkas Desa</div>
                <form action="{{url('desa/proses/excel')}}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="fungsi" value="Import">
                        <div class="row mb-3">
                            <label for="file" class="col-md-4 col-form-label text-md-end">Pilih File</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control-file" id="data_file" name="data_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" onchange="return fileValidation()">
                            </div>
                        </div>
                        <div class=" row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Upload</button>
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
            /(\.xls|\.xlsx)$/i;

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
</script>
@endsection