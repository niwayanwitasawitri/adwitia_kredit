<div class="sidebar-card">


<div class="sidebar-header">
    🧾 KASIR PANEL
</div>

<a href="{{ route('kasir.dashboard') }}"
   class="list-group-item sidebar-link {{ Request::is('kasir/dashboard*') ? 'active' : '' }}">
    <i class="fas fa-home"></i>
    Dashboard
</a>

@if(
    auth()->user()->hasPermission('read.penjualan') ||
    auth()->user()->hasPermission('read.piutang') ||
    auth()->user()->hasPermission('read.produk') ||
    auth()->user()->hasPermission('read.pelanggan')
)

<div class="sidebar-section">
    TRANSAKSI
</div>

@endif

@if(auth()->user()->hasPermission('read.penjualan'))

<a href="{{ route('kasir.penjualan.index') }}"
   class="list-group-item sidebar-link {{ Request::is('kasir/penjualan*') ? 'active' : '' }}">
    <i class="fas fa-shopping-cart"></i>
    Penjualan
</a>

<a href="{{ route('kasir.riwayat.index') }}"
   class="list-group-item sidebar-link {{ Request::is('kasir/riwayat*') ? 'active' : '' }}">
    <i class="fas fa-history"></i>
    Riwayat Penjualan
</a>

@endif

@if(auth()->user()->hasPermission('read.piutang'))

<a href="{{ route('kasir.piutang.index') }}"
   class="list-group-item sidebar-link {{ Request::is('kasir/piutang*') ? 'active' : '' }}">
    <i class="fas fa-file-invoice-dollar"></i>
    Piutang
</a>

@endif

@if(auth()->user()->hasPermission('read.produk'))

<a href="{{ route('kasir.produk.index') }}"
   class="list-group-item sidebar-link {{ Request::is('kasir/produk*') ? 'active' : '' }}">
    <i class="fas fa-seedling"></i>
    Produk
</a>

@endif

@if(auth()->user()->hasPermission('read.pelanggan'))

<a href="{{ route('kasir.pelanggan.index') }}"
   class="list-group-item sidebar-link {{ Request::is('kasir/pelanggan*') ? 'active' : '' }}">
    <i class="fas fa-user-friends"></i>
    Pelanggan
</a>

@endif


@if(
    auth()->user()->hasPermission('read.user') ||
    auth()->user()->hasPermission('read.role') ||
    auth()->user()->hasPermission('read.permission')
)

<div class="sidebar-section">
    DATA MASTER
</div>

@endif

@if(auth()->user()->hasPermission('read.user'))

<a href="{{ route('admin.users.index') }}"
   class="list-group-item sidebar-link {{ Request::is('admin/users*') ? 'active' : '' }}">
    <i class="fas fa-users"></i>
    User
</a>

@endif

@if(auth()->user()->hasPermission('read.role'))

<a href="{{ route('admin.roles.index') }}"
   class="list-group-item sidebar-link {{ Request::is('admin/roles*') ? 'active' : '' }}">
    <i class="fas fa-user-tag"></i>
    Role
</a>

@endif

@if(auth()->user()->hasPermission('read.permission'))

<a href="{{ route('admin.permissions.index') }}"
   class="list-group-item sidebar-link {{ Request::is('admin/permissions*') ? 'active' : '' }}">
    <i class="fas fa-key"></i>
    Permission
</a>

@endif


@if(
    auth()->user()->hasPermission('read.laporan-penjualan') ||
    auth()->user()->hasPermission('read.laporan-kredit') ||
    auth()->user()->hasPermission('read.laporan-piutang') ||
    auth()->user()->hasPermission('read.laporan-stok')
)

<div class="sidebar-section">
    LAPORAN
</div>

@endif

@if(auth()->user()->hasPermission('read.laporan-penjualan'))

<a href="{{ route('owner.laporan-penjualan.index') }}"
   class="list-group-item sidebar-link {{ Request::is('owner/laporan-penjualan*') ? 'active' : '' }}">
    <i class="fas fa-chart-line"></i>
    Laporan Penjualan
</a>

@endif

@if(auth()->user()->hasPermission('read.laporan-kredit'))

<a href="{{ route('owner.laporan-kredit.index') }}"
   class="list-group-item sidebar-link {{ Request::is('owner/laporan-kredit*') ? 'active' : '' }}">
    <i class="fas fa-credit-card"></i>
    Laporan Kredit
</a>

@endif

@if(auth()->user()->hasPermission('read.laporan-piutang'))

<a href="{{ route('owner.laporan-piutang.index') }}"
   class="list-group-item sidebar-link {{ Request::is('owner/laporan-piutang*') ? 'active' : '' }}">
    <i class="fas fa-file-invoice"></i>
    Laporan Piutang
</a>

@endif

@if(auth()->user()->hasPermission('read.laporan-stok'))

<a href="{{ route('owner.laporan-stok.index') }}"
   class="list-group-item sidebar-link {{ Request::is('owner/laporan-stok*') ? 'active' : '' }}">
    <i class="fas fa-boxes"></i>
    Laporan Stok
</a>

@endif


</div>

<style>
.sidebar-card{
    background:#fff;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 4px 20px rgba(0,0,0,.08);
}

.sidebar-header{
    background:linear-gradient(135deg,#4CAF50,#81C784);
    color:white;
    padding:18px;
    font-weight:700;
    text-align:center;
    font-size:18px;
    letter-spacing:.5px;
}

.sidebar-section{
    background:#E8F5E9;
    color:#2E7D32;
    font-weight:700;
    padding:12px 18px;
}

.sidebar-link{
    border:none !important;
    padding:12px 18px;
    transition:.3s;
    color:#444;
    font-weight:500;
    text-decoration:none;
    display:block;
}

.sidebar-link:hover{
    background:#E8F5E9;
    color:#2E7D32;
    padding-left:25px;
}

.sidebar-link.active{
    background:#4CAF50 !important;
    color:white !important;
}

.sidebar-link i{
    width:22px;
}
</style>