<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mitra.id</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/datatables/css/datatables.min.css') }}">
</head>
<body>
  <div class="d-flex">
    <aside class="d-flex flex-column p-3 bg-primary bg-gradient min-vh-100 text-white" style="width: 280px;">
      <a href="{{ route('products.index') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none link-light">
        <span class="fs-4">Mitra.id</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="{{ route('products.index') }}" class="nav-link link-light" aria-current="page">
            <i class="fa-solid fa-cubes me-1"></i>
            Produk
          </a>
      </ul>
    </aside>
    <div class="container-fluid p-0">
      <div class="shadow d-flex align-items-center bg-white w-100 px-4" style="height: 69px">
        <div class="ms-auto">
          <span class="me-2 d-none d-lg-inline text-gray-600 small">Supplier</span>
          <img class="img-profile rounded-circle" src="{{ asset('images/user.jpg') }}" style="width: 35px">
        </div>
      </div>
      <div class="m-4">
        @yield('content')
      </div>
    </div>
  </div>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/js/datatables.min.js') }}"></script>
  <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
  @stack('scripts')
</body>
</html>