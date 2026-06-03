<!DOCTYPE html>

<html lang="id">

<head>


<meta charset="UTF-8">

<title>
    @yield('title','Owner Panel')
</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">


</head>

<body>


@include('layouts.owner.navbar')

<div class="container-fluid py-3">

    <div class="row g-3 align-items-start">

        <div class="col-lg-3 col-md-4">

            @include('layouts.owner.sidebar')

        </div>

        <div class="col-lg-9 col-md-8">

            @yield('content')

        </div>

    </div>

</div>

@include('layouts.owner.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>