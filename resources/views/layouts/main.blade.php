<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('global/css/lightgallery-bundle.min.css')}}">
  <link rel="stylesheet" href="{{ asset('global/css/all.min.css')}}">
  <link rel="stylesheet" href="{{ asset('global/css/style.css')}}">

  <!-- JavaScript Bundle with Popper -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('global/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('global/js/lightgallery.min.js') }}"></script>

    <script src="{{ asset('global/js/sweetalert2@10.js') }}"></script>
</head>
<body>
<main>
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-md">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="./imgs/logo.png" alt="" width="80" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" href="#Home" data-scroll="Home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#services" data-scroll="services">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#projects" data-scroll="projects">Projects</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#clients" data-scroll="clients">Clients</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact" data-scroll="contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#copyright" data-scroll="copyright">Copyright</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    @yield('content')
  <script src="{{ asset('global/js/main.js') }}"></script>
</body>
</html>
