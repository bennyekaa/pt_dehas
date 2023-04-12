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
  <!-- Waduk Content -->
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waduk</title>
    <!-- data tables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  </head>
  <body>
    <h1>Waduk</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <button class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i>tambah</button>
                </div>
                <div class="box-body">
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>Waduk</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </body>
  </html>
  <!-- Waduk Content -->
  <script src="{{asset('Template')}}/vendor/jquery/jquery.min.js"></script>
  <script src="{{asset('Template')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('Template')}}/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="{{asset('Template')}}/js/ruang-admin.min.js"></script>

  
  <!-- data tables -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $('.table').DataTable();
</script>
</body>

</html>

@endsection