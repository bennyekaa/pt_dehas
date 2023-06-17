@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">RESET PASSWORD</div>

                    <div class="card-body">
                        <form action="{{ url('prosesreset') }}" method="POST">

                            @csrf

                            <input type="hidden" name="id_user" value="{{$user}}">

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control form-control-border" id="password"
                                            placeholder="Masukkan Password" name="password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">Ulangi Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control form-control-border" id="ulangi_password"
                                            placeholder="Ulangi Password" name="ulangi_password">
                                </div>
                            </div>
                            <input type="checkbox" onclick="myFunction()"> Lihat Password
                            <div class="card-footer">
                                    <a class="btn btn-warning" type="reset" href="{{ url()->previous() }}">TUTUP</a>
                                    <button type="submit" class="btn btn-success">SIMPAN</button>
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
        window.onload = function() {
            document.getElementById("password").onchange = validatePassword;
            document.getElementById("ulangi_password").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("ulangi_password").value;
            var pass1 = document.getElementById("password").value;
            if (pass1 != pass2)
                document.getElementById("ulangi_password").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
            else
                document.getElementById("ulangi_password").setCustomValidity('');
        }

        function myFunction() {
            var x = document.getElementById("password");
            var y = document.getElementById("ulangi_password");
            if (x.type === "password" && y.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        }
    </script>
@endsection
