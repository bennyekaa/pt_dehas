<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('assets/img/logo/pt_dehas.jpg') }}" rel="icon">
    <title>PT Dehas Inframedia Karsa - Deshboard</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<section class="vh-100" style="background-image: url('assets/img/bendungan.jpg')">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif
                        <h3 class="mb-5" style="text-align: left">Log in</h3>
                        <form action="{{ url('actionlogin') }}" method="post">
                            @csrf
                            <div class="form-outline mb-4" style="text-align: left">
                                <label class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Masukkan Email" />
                            </div>

                            <div class="form-outline mb-4" style="text-align: left">
                                <label class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Masukkan Password" />
                                <br>
                                <input type="checkbox" onclick="myFunction()"> Lihat Password
                            </div>
                            {{-- <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-start mb-4">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                                <label class="form-check-label" for="form1Example3"> Remember password </label>
                            </div> --}}

                            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                        </form>

                        <hr class="my-4">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('assets/jquery/jquery-3.1.1.min.js') }}"></script>
<script type="text/javascript">
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>