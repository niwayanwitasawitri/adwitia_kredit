<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>
    ADWITIA KREDIT
</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

    body{
        font-family:'Segoe UI',sans-serif;
    }

    .hero{

        min-height:100vh;

        background:
        linear-gradient(
            rgba(46,125,50,.75),
            rgba(76,175,80,.75)
        ),

        url('https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=1600&q=80');

        background-size:cover;
        background-position:center;

        color:white;

        display:flex;
        align-items:center;
    }

    .section-title{
        color:#2E7D32;
        font-weight:800;
        margin-bottom:20px;
    }

    .feature-card{

        border:none;

        border-radius:20px;

        transition:.3s;

        box-shadow:
        0 4px 20px rgba(0,0,0,.08);
    }

    .feature-card:hover{

        transform:translateY(-8px);
    }

    .role-card{

        border:none;

        border-radius:20px;

        transition:.3s;

        box-shadow:
        0 4px 20px rgba(0,0,0,.08);
    }

    .role-card:hover{

        transform:translateY(-8px);
    }

    .btn-login{

        background:#fff;
        color:#2E7D32;

        border:none;

        font-weight:700;

        padding:12px 30px;

        border-radius:50px;
    }

    .btn-login:hover{

        background:#E8F5E9;
    }

    footer{

        background:#2E7D32;

        color:white;

        padding:30px;
    }

</style>

</head>

<body>

<!-- HERO -->

<section class="hero">

<div class="container">

    <div class="row align-items-center">

        <div class="col-lg-7">

            <h1 class="display-4 fw-bold">

                🌱 SISTEM PENJUALAN OBAT PERTANIAN

            </h1>

            <p class="lead mt-4">

                Solusi Digital untuk Mengelola Penjualan,
                Kredit, Piutang dan Laporan Obat Pertanian
                secara cepat, akurat dan terintegrasi.

            </p>

            <div class="mt-4">

                 <a href="/login"
                     class="btn btn-light btn-lg rounded-pill px-5">
                  Login Sekarang
              </a>

            </div>

        </div>

    </div>

</div>

</section>

<!-- TENTANG -->

<section class="py-5">


<div class="container text-center">

    <h2 class="section-title">

        Tentang Sistem

    </h2>

    <p class="text-muted">

        ADWITIA KREDIT merupakan sistem informasi
        penjualan obat pertanian yang membantu
        pengelolaan transaksi tunai, kredit,
        piutang pelanggan, stok produk dan laporan
        secara terintegrasi.

    </p>

</div>


</section>

<!-- FITUR -->

<section class="py-5 bg-light">


<div class="container">

    <h2 class="section-title text-center">

        Fitur Utama

    </h2>

    <div class="row g-4">

        <div class="col-md-4">

            <div class="card feature-card p-4 text-center h-100">

                <i class="fas fa-shopping-cart fa-3x text-success mb-3"></i>

                <h5>Penjualan</h5>

                <p>
                    Kelola transaksi penjualan
                    dengan cepat dan akurat.
                </p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card feature-card p-4 text-center h-100">

                <i class="fas fa-file-invoice-dollar fa-3x text-success mb-3"></i>

                <h5>Piutang</h5>

                <p>
                    Monitoring kredit dan
                    piutang pelanggan.
                </p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card feature-card p-4 text-center h-100">

                <i class="fas fa-chart-line fa-3x text-success mb-3"></i>

                <h5>Laporan</h5>

                <p>
                    Laporan penjualan dan stok
                    secara real-time.
                </p>

            </div>

        </div>

    </div>

</div>


</section>

<!-- ROLE -->

<section class="py-5">


<div class="container">

    <h2 class="section-title text-center">

        Pengguna Sistem

    </h2>

    <div class="row g-4">

        <div class="col-md-4">

            <div class="card role-card p-4 text-center">

                <h4>👨‍💼 Admin</h4>

                <p>
                    Mengelola data master,
                    user dan hak akses.
                </p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card role-card p-4 text-center">

                <h4>🧾 Kasir</h4>

                <p>
                    Mengelola transaksi,
                    pelanggan dan piutang.
                </p>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card role-card p-4 text-center">

                <h4>👑 Owner</h4>

                <p>
                    Monitoring laporan dan
                    pengambilan keputusan.
                </p>

            </div>

        </div>

    </div>

</div>


</section>

<!-- CTA -->

<section class="py-5 text-center bg-success text-white">

    <div class="container">

        <h2>
            Siap Mengelola Penjualan Lebih Mudah?
        </h2>

        <p>
            Masuk ke sistem dan mulai kelola
            bisnis pertanian Anda sekarang.
        </p>

        <a href="/login"
           class="btn btn-light btn-lg rounded-pill px-5">
            Login Sekarang
        </a>

    </div>

</section>

<footer class="text-center">


<h5>🌱 ADWITIA KREDIT</h5>

<p class="mb-1">
    Sistem Penjualan Obat Pertanian
</p>

<small>
    © {{ date('Y') }} Semua Hak Dilindungi
</small>


</footer>

</body>

</html>