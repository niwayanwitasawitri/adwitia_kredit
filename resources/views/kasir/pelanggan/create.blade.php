@extends('layouts.kasir.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="container-fluid px-3 px-md-4 py-3">

    <div class="mb-4 text-center">
        <div class="py-2">
            <h3 class="fw-bold text-dark mb-1 fs-4 fs-md-3">Tambah Data Pelanggan</h3>
            <p class="text-muted small mb-0">Masukkan informasi profil, nomor kontak, dan alamat pelanggan baru di bawah ini.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3 max-width-container mx-auto mb-4">
        <div class="card-body p-4">
            <form action="{{ route('kasir.pelanggan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-uppercase fs-7 text-muted fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-control px-3 py-2.5 rounded-2 @error('nama') is-invalid @enderror" placeholder="Masukkan nama pelanggan baru" required>
                    @error('nama')
                        <div class="invalid-feedback small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label text-uppercase fs-7 text-muted fw-semibold">No. Telepon / WA</label>
                    <input type="text" name="telepon" value="{{ old('telepon') }}" class="form-control px-3 py-2.5 rounded-2 @error('telepon') is-invalid @enderror" placeholder="Contoh: 08123456xxx">
                    @error('telepon')
                        <div class="invalid-feedback small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase fs-7 text-muted fw-semibold">Alamat Rumah</label>
                    <textarea name="alamat" class="form-control px-3 py-2.5 rounded-2 @error('alamat') is-invalid @enderror" rows="3" placeholder="Masukkan alamat lengkap pelanggan baru">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid d-sm-flex justify-content-sm-end pt-2 border-top">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-2 shadow-sm fw-medium">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-start max-width-container mx-auto pt-2">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-light border text-secondary px-3 py-2 rounded-2 shadow-sm d-inline-flex align-items-center gap-2">
            <span>&larr;</span> Kembali
        </a>
    </div>

</div>

<style>
    .fs-7 {
        font-size: 0.72rem;
        letter-spacing: 0.5px;
    }
    .max-width-container {
        max-width: 650px; /* Dibuat ringkas agar form input terfokus di tengah monitor */
    }
    .py-2.5 { padding-top: 0.65rem !important; padding-bottom: 0.65rem !important; }
    .gap-2 { gap: 0.5rem !important; }
</style>
@endsection