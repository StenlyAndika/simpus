<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="Website E-Monev Bulanan Kota Sungai Penuh">
    <meta name="keywords" content="E-Monev kota sungai penuh">
    <meta name="author" content="Pemerintah Kota Sungai Penuh">

    <link rel="icon" href="/img/tablogo.png">
    <title>{{ $title }}</title>

    <!-- Vendor CSS STYLE -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/vendor/aos/aos.css">
    <link href="/rocker/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="/rocker/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="/rocker/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="/rocker/css/app.css" rel="stylesheet">
    <link href="/rocker/css/bootstrap-extended.css" rel="stylesheet">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>

    @yield('container')

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="/vendor/aos/aos.js"></script>
    <script src="/js/main.js"></script>
    <script src="/rocker/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/rocker/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/rocker/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="/rocker/js/app.js"></script>
    
    @include('sweetalert::alert')
</body>
</html>