@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{asset('gambar')}}/pt-dehas.jpg" rel="icon">
  <title>PT DEHAS - Register</title>
  <link href="{{asset('Template')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="{{asset('Template')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="{{asset('Template')}}/css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Register Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                  </div>
                  <form>
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" class="form-control" id="exampleInputLastName" placeholder="Masukan Alamat Email">
                    </div>
                    <div class="form-group">
                      <label>Username</label>
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Masukan Username">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label>Ulangi Password</label>
                      <input type="password" class="form-control" id="exampleInputPasswordRepeat"
                        placeholder="Ulangi Password">
                    </div>
                    <form action="/action_page.php">
                    <div>

                    </div>
                        <label for="jabatan">Jabatan:</label>
                        <select class="form-control mb-3" name="jabatan" id="role">
                            <option value="1">Lurah</option>
                            <option value="2">Petugas BPPD</option>
                            <option value="3">Bupati</option>
                            <option value="0">Kepala Desa</option>
                        </select>
                        <br><br>
                    </div>
                  </form>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Apakah anda sudah yakin dengan data diri anda?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Kembali</button>
                  <button type="button" class="btn btn-primary">Simpan</button>
                </div>
              </div>
            </div>
        </div>

                <div class="card-body">
                  <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal"
                    id="#myBtn">
                    Daftar
                  </button>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Register Content -->
  <script src="{{asset('Template')}}/vendor/jquery/jquery.min.js"></script>
  <script src="{{asset('Template')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('Template')}}/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="{{asset('Template')}}/js/ruang-admin.min.js"></script>
</body>

</html>

@endsection