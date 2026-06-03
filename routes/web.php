<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\KategoriProdukController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\PelangganController as AdminPelangganController;
use App\Http\Controllers\Admin\PembayaranController;

/*
|--------------------------------------------------------------------------
| KASIR
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Kasir\DashboardController as KasirDashboardController;
use App\Http\Controllers\Kasir\PenjualanController;
use App\Http\Controllers\Kasir\ProdukController as KasirProdukController;
use App\Http\Controllers\Kasir\PelangganController as KasirPelangganController;
use App\Http\Controllers\Kasir\RiwayatPenjualanController;
use App\Http\Controllers\Kasir\PiutangController;


/*
|--------------------------------------------------------------------------
| OWNER
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\LaporanPenjualanController;
use App\Http\Controllers\Owner\LaporanKreditController;
use App\Http\Controllers\Owner\LaporanPiutangController;
use App\Http\Controllers\Owner\LaporanStokController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| GUEST
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [
        LoginController::class,
        'index'
    ])->name('login');

    Route::post('/login', [
        LoginController::class,
        'authenticate'
    ])->name('login.authenticate');

    Route::get('/register', [
        RegisterController::class,
        'index'
    ])->name('register');

    Route::post('/register', [
        RegisterController::class,
        'store'
    ])->name('register.store');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [
        LoginController::class,
        'logout'
    ])->name('logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth'
])
->prefix('admin')
->name('admin.')
->group(function () {

    Route::get('/dashboard',
        [AdminDashboardController::class,'index']
    )->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | USERS
    |--------------------------------------------------------------------------
    */

    Route::middleware('permission:read.user')
        ->get('/users',
            [UserController::class,'index'])
        ->name('users.index');

    Route::middleware('permission:create.user')
        ->get('/users/create',
            [UserController::class,'create'])
        ->name('users.create');

    Route::middleware('permission:create.user')
        ->post('/users',
            [UserController::class,'store'])
        ->name('users.store');

    Route::middleware('permission:read.user')
        ->get('/users/{user}',
            [UserController::class,'show'])
        ->name('users.show');

    Route::middleware('permission:update.user')
        ->get('/users/{user}/edit',
            [UserController::class,'edit'])
        ->name('users.edit');

    Route::middleware('permission:update.user')
        ->put('/users/{user}',
            [UserController::class,'update'])
        ->name('users.update');

    Route::middleware('permission:update.user')
        ->put('/users/{user}/password',
            [UserController::class,'updatePassword'])
        ->name('users.password');

    Route::middleware('permission:delete.user')
        ->delete('/users/{user}',
            [UserController::class,'destroy'])
        ->name('users.destroy');

    /*
    |--------------------------------------------------------------------------
    | ROLES
    |--------------------------------------------------------------------------
    */

    Route::middleware('permission:read.role')
        ->get('/roles',
            [RoleController::class,'index'])
        ->name('roles.index');

    Route::middleware('permission:create.role')
        ->get('/roles/create',
            [RoleController::class,'create'])
        ->name('roles.create');

    Route::middleware('permission:create.role')
        ->post('/roles',
            [RoleController::class,'store'])
        ->name('roles.store');

    Route::middleware('permission:read.role')
        ->get('/roles/{role}',
            [RoleController::class,'show'])
        ->name('roles.show');

    Route::middleware('permission:update.role')
        ->get('/roles/{role}/edit',
            [RoleController::class,'edit'])
        ->name('roles.edit');

    Route::middleware('permission:update.role')
        ->put('/roles/{role}',
            [RoleController::class,'update'])
        ->name('roles.update');

    Route::middleware('permission:delete.role')
        ->delete('/roles/{role}',
            [RoleController::class,'destroy'])
        ->name('roles.destroy');

    /*
    |--------------------------------------------------------------------------
    | PERMISSIONS
    |--------------------------------------------------------------------------
    */

    Route::middleware('permission:read.permission')
        ->get('/permissions',
            [PermissionController::class,'index'])
        ->name('permissions.index');

    Route::middleware('permission:create.permission')
        ->get('/permissions/create',
            [PermissionController::class,'create'])
        ->name('permissions.create');

    Route::middleware('permission:create.permission')
        ->post('/permissions',
            [PermissionController::class,'store'])
        ->name('permissions.store');

    Route::middleware('permission:read.permission')
        ->get('/permissions/{permission}',
            [PermissionController::class,'show'])
        ->name('permissions.show');

    Route::middleware('permission:update.permission')
        ->get('/permissions/{permission}/edit',
            [PermissionController::class,'edit'])
        ->name('permissions.edit');

    Route::middleware('permission:update.permission')
        ->put('/permissions/{permission}',
            [PermissionController::class,'update'])
        ->name('permissions.update');

    Route::middleware('permission:delete.permission')
        ->delete('/permissions/{permission}',
            [PermissionController::class,'destroy'])
        ->name('permissions.destroy');

    /*
    |--------------------------------------------------------------------------
    | KATEGORI PRODUK
    |--------------------------------------------------------------------------
    */

    Route::resource('kategori-produk',
        KategoriProdukController::class);

    /*
    |--------------------------------------------------------------------------
    | PRODUK
    |--------------------------------------------------------------------------
    */

    Route::resource('produk',
        AdminProdukController::class);

    /*
    |--------------------------------------------------------------------------
    | PELANGGAN
    |--------------------------------------------------------------------------
    */

    Route::resource('pelanggan',
        AdminPelangganController::class);

    /*
    |--------------------------------------------------------------------------
    | PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    Route::middleware('permission:read.pembayaran')
        ->get('/pembayaran',
            [PembayaranController::class,'index'])
        ->name('pembayaran.index');

    Route::middleware('permission:read.pembayaran')
        ->get('/pembayaran/{pembayaran}',
            [PembayaranController::class,'show'])
        ->name('pembayaran.show');

    Route::middleware('permission:delete.pembayaran')
        ->delete('/pembayaran/{pembayaran}',
            [PembayaranController::class,'destroy'])
        ->name('pembayaran.destroy');
});

/*
|--------------------------------------------------------------------------
| KASIR
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth'
])
->prefix('kasir')
->name('kasir.')
->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [KasirDashboardController::class,'index']
    )->name(
        'dashboard'
    );

    /*
    |--------------------------------------------------------------------------
    | PENJUALAN
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'penjualan',
        PenjualanController::class
    );

    /*
    |--------------------------------------------------------------------------
    | PRODUK
    |--------------------------------------------------------------------------
    */

    Route::middleware('permission:read.produk')
        ->get(
            '/produk',
            [KasirProdukController::class,'index']
        )
        ->name(
            'produk.index'
        );

    Route::middleware('permission:read.produk')
        ->get(
            '/produk/{produk}',
            [KasirProdukController::class,'show']
        )
        ->name(
            'produk.show'
        );

    /*
    |--------------------------------------------------------------------------
    | PELANGGAN
    |--------------------------------------------------------------------------
    */

    Route::middleware('permission:read.pelanggan')
        ->get(
            '/pelanggan',
            [KasirPelangganController::class,'index']
        )
        ->name(
            'pelanggan.index'
        );

    Route::middleware('permission:create.pelanggan')
        ->get(
            '/pelanggan/create',
            [KasirPelangganController::class,'create']
        )
        ->name(
            'pelanggan.create'
        );

    Route::middleware('permission:create.pelanggan')
        ->post(
            '/pelanggan',
            [KasirPelangganController::class,'store']
        )
        ->name(
            'pelanggan.store'
        );

    Route::middleware('permission:read.pelanggan')
        ->get(
            '/pelanggan/{pelanggan}',
            [KasirPelangganController::class,'show']
        )
        ->name(
            'pelanggan.show'
        );

    Route::middleware('permission:update.pelanggan')
        ->get(
            '/pelanggan/{pelanggan}/edit',
            [KasirPelangganController::class,'edit']
        )
        ->name(
            'pelanggan.edit'
        );

    Route::middleware('permission:update.pelanggan')
        ->put(
            '/pelanggan/{pelanggan}',
            [KasirPelangganController::class,'update']
        )
        ->name(
            'pelanggan.update'
        );

   /*
|--------------------------------------------------------------------------
| RIWAYAT PENJUALAN
|--------------------------------------------------------------------------
*/

Route::middleware('permission:read.penjualan')
    ->get(
        '/riwayat',
        [RiwayatPenjualanController::class,'index']
    )
    ->name(
        'riwayat.index'
    );

Route::middleware('permission:print.riwayat-penjualan')
    ->get(
        '/riwayat/cetak',
        [RiwayatPenjualanController::class,'cetak']
    )
    ->name(
        'riwayat.cetak'
    );

Route::middleware('permission:read.penjualan')
    ->get(
        '/riwayat/{penjualan}',
        [RiwayatPenjualanController::class,'show']
    )
    ->name(
        'riwayat.show'
    );
    
    /*
    |--------------------------------------------------------------------------
    | PIUTANG
    |--------------------------------------------------------------------------
    */

    Route::middleware('permission:read.piutang')
        ->get(
            '/piutang',
            [PiutangController::class,'index']
        )
        ->name(
            'piutang.index'
        );

    Route::middleware('permission:read.piutang')
        ->get(
            '/piutang/{piutang}',
            [PiutangController::class,'show']
        )
        ->name(
            'piutang.show'
        );

    Route::middleware('permission:create.cicilan')
        ->post(
            '/piutang/{piutang}/bayar',
            [PiutangController::class,'bayar']
        )
        ->name(
            'piutang.bayar'
        );

});



Route::middleware([
'auth'
])
->prefix('owner')
->name('owner.')
->group(function () {


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get(
    '/dashboard',
    [OwnerDashboardController::class, 'index']
)->name(
    'dashboard'
);

/*
|--------------------------------------------------------------------------
| LAPORAN PENJUALAN
|--------------------------------------------------------------------------
*/

Route::get(
    '/laporan-penjualan',
    [LaporanPenjualanController::class, 'index']
)
->middleware('permission:read.laporan-penjualan')
->name('laporan-penjualan.index');

Route::get(
    '/laporan-penjualan/cetak',
    [LaporanPenjualanController::class, 'cetak']
)
->middleware('permission:print.laporan-penjualan')
->name('laporan-penjualan.cetak');

Route::get(
    '/laporan-penjualan/{penjualan}',
    [LaporanPenjualanController::class, 'show']
)
->middleware('permission:read.laporan-penjualan')
->name('laporan-penjualan.show');

/*
|--------------------------------------------------------------------------
| LAPORAN KREDIT
|--------------------------------------------------------------------------
*/

Route::get(
    '/laporan-kredit',
    [LaporanKreditController::class, 'index']
)
->middleware('permission:read.laporan-kredit')
->name('laporan-kredit.index');

Route::get(
    '/laporan-kredit/cetak',
    [LaporanKreditController::class, 'cetak']
)
->middleware('permission:print.laporan-kredit')
->name('laporan-kredit.cetak');

Route::get(
    '/laporan-kredit/{penjualan}',
    [LaporanKreditController::class, 'show']
)
->middleware('permission:read.laporan-kredit')
->name('laporan-kredit.show');

/*
|--------------------------------------------------------------------------
| LAPORAN PIUTANG
|--------------------------------------------------------------------------
*/

Route::get(
    '/laporan-piutang',
    [LaporanPiutangController::class, 'index']
)
->middleware('permission:read.laporan-piutang')
->name('laporan-piutang.index');

Route::get(
    '/laporan-piutang/cetak',
    [LaporanPiutangController::class, 'cetak']
)
->middleware('permission:print.laporan-piutang')
->name('laporan-piutang.cetak');

Route::get(
    '/laporan-piutang/{piutang}',
    [LaporanPiutangController::class, 'show']
)
->middleware('permission:read.laporan-piutang')
->name('laporan-piutang.show');

/*
|--------------------------------------------------------------------------
| LAPORAN STOK
|--------------------------------------------------------------------------
*/

Route::get(
    '/laporan-stok',
    [LaporanStokController::class, 'index']
)
->middleware('permission:read.laporan-stok')
->name('laporan-stok.index');

Route::get(
    '/laporan-stok/cetak',
    [LaporanStokController::class, 'cetak']
)
->middleware('permission:print.laporan-stok')
->name('laporan-stok.cetak');

Route::get(
    '/laporan-stok/{produk}',
    [LaporanStokController::class, 'show']
)
->middleware('permission:read.laporan-stok')
->name('laporan-stok.show');


});