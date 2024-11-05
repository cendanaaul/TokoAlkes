<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko Kesehatan</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('/asset/image/logo.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('/asset/css/style.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js-->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body>

    <!-- untuk memanggil file navbar pada folder layout -->
    @include('layout.nav')

    <div class=" w-full min-h-[65vh] px-5">
        @yield('container')
    </div>

    @include('layout.footer')

    <script src="{{ asset('/asset/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
