<!DOCTYPE html>

<html lang="id">

<head>


<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>
    @yield('title')
</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

    body{
        min-height:100vh;

        background:
        linear-gradient(
            135deg,
            #4CAF50,
            #81C784
        );

        display:flex;
        align-items:center;
        justify-content:center;

        font-family:'Segoe UI',sans-serif;
    }

    .auth-card{

        width:100%;
        max-width:500px;

        border:none;
        border-radius:25px;

        overflow:hidden;

        box-shadow:
        0 10px 35px rgba(0,0,0,.15);
    }

    .auth-header{

        background:
        linear-gradient(
            135deg,
            #4CAF50,
            #66BB6A
        );

        color:white;

        text-align:center;

        padding:30px 20px;
    }

    .auth-header h2{
        margin:0;
        font-weight:800;
    }

    .auth-header p{
        margin-top:8px;
        opacity:.9;
    }

    .auth-body{
        padding:30px;
        background:white;
    }

    .form-control{

        border-radius:12px;

        padding:12px;

        border:1px solid #dcdcdc;
    }

    .form-control:focus{

        border-color:#4CAF50;

        box-shadow:
        0 0 0 .2rem
        rgba(76,175,80,.15);
    }

    .btn-login{

        background:#4CAF50;
        border:none;

        padding:12px;

        border-radius:12px;

        font-weight:700;
    }

    .btn-login:hover{
        background:#43A047;
    }

    .btn-register{

        background:#2E7D32;
        border:none;

        padding:12px;

        border-radius:12px;

        font-weight:700;
    }

    .btn-register:hover{
        background:#1B5E20;
    }

    .brand-icon{
        font-size:40px;
    }

    .auth-footer{
        text-align:center;
        margin-top:15px;
    }

</style>


</head>

<body>

<div class="card auth-card">

    <div class="auth-header">

        <div class="brand-icon">
            🌱
        </div>

        <h2>
            SISTEM PENJUALAN OBAT PERTANIAN
        </h2>

        <p>
            ADWITIA KREDIT
        </p>

    </div>

    <div class="auth-body">

        @yield('content')

    </div>

</div>


</body>

</html>