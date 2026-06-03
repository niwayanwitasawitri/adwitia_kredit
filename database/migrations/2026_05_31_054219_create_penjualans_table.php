<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {

    $table->id();

    $table->foreignId('user_id')
        ->constrained('users')
        ->cascadeOnDelete();

    $table->foreignId('pelanggan_id')
        ->constrained('pelanggans')
        ->cascadeOnDelete();

    $table->string('kode_penjualan')
        ->unique();

    $table->date('tanggal');

    $table->decimal('total',15,2);

    $table->enum('status',[
        'belum_lunas',
        'lunas'
    ])->default('belum_lunas');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};