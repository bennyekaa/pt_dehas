@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Berkas Pendukung</div>
                    <div class="card-body">
                        <form action="{{ url('pendukung/proses') }}" method="post" enctype="multipart/form-data">

                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="col-md-4 col-form-label text-md-end">URL</label>
                                    <div class="col-md-8">
                                        <input type="text" name="url" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="file" name="berkas" class="col-md-4 col-form-label text-md-end">Upload
                                        Berkas</label>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control-file mb-3" id="data_file" name="data_file"
                                            accept="image/*, application/pdf">
                                        <p class="m-t-sm">
                                            Tipe file yang diperbolehkan jpg, jpeg ,png atau PDF.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="keterangan" class="col-md-4 col-form-label text-md-end">Keterangan</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="keterangan"></textarea>
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
    </script>
@endsection
