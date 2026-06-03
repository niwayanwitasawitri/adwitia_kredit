<nav class="navbar navbar-expand-lg navbar-dark shadow-sm"
     style="background: linear-gradient(135deg,#4CAF50,#81C784);">

<div class="container-fluid">

    <span class="navbar-brand fw-bold">
        🌱 SISTEM PENJUALAN OBAT PERTANIAN
    </span>

    <div class="d-flex align-items-center gap-3">


        <span class="text-white fw-semibold">
            <i class="fas fa-user-circle me-1"></i>
            {{ auth()->user()->name }}
        </span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit"
                    class="btn btn-light btn-sm rounded-pill px-3 fw-semibold">
                <i class="fas fa-sign-out-alt me-1"></i>
                Logout
            </button>
        </form>

    </div>

</div>


</nav>