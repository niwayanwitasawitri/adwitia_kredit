@extends('layouts.kasir.app')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="container-fluid px-3 px-md-4 py-3">

    <div class="mb-4 text-center">
        <div class="py-2">
            <h3 class="fw-bold text-dark mb-1 fs-4 fs-md-3">Edit Data Pelanggan</h3>
            <p class="text-muted small mb-0">Perbarui informasi profil, nomor kontak, atau alamat pelanggan di bawah ini.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3 max-width-container mx-auto mb-4">
        <div class="card-body p-4">
            <form action="{{ route('kasir.pelanggan.update', $pelanggan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label text-uppercase fs-7 text-muted fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $pelanggan->nama) }}" class="form-control px-3 py-2.5 rounded-2 @error('nama') is-invalid @enderror" placeholder="Masukkan nama pelanggan" required>
                    @error('nama')
                        <div class="invalid-feedback small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label text-uppercase fs-7 text-muted fw-semibold">No. Telepon / WA</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $pelanggan->telepon) }}" class="form-control px-3 py-2.5 rounded-2 @error('telepon') is-invalid @enderror" placeholder="Contoh: 08123456xxx">
                    @error('telepon')
                        <div class="invalid-feedback small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-uppercase fs-7 text-muted fw-semibold">Alamat Rumah</label>
                    <textarea name="alamat" class="form-control px-3 py-2.5 rounded-2 @error('alamat') is-invalid @enderror" rows="3" placeholder="Masukkan alamat lengkap pelanggan">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid d-sm-flex justify-content-sm-end pt-2 border-top">
                    <button type="submit" class="btn btn-warning text-white px-4 py-2 rounded-2 shadow-sm fw-medium">
                        Simpan Perubahan
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
        max-width: 650px; /* Dibuat sedikit lebih ringkas agar form input fokus dan estetik */
    }
    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
    }
    .py-2.5 { padding-top: 0.65rem !important; padding-bottom: 0.65rem !important; }
    .gap-2 { gap: 0.5rem !important; }
</style>
@endsection