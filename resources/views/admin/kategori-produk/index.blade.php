@extends('layouts.admin.app')

@section('title','Kategori Produk')

@section('content')

<style>
    .page-header{
        background: linear-gradient(135deg,#4CAF50,#81C784);
        border-radius: 20px;
        padding: 20px 25px;
        color: white;
        margin-bottom: 25px;
        box-shadow: 0 8px 20px rgba(76,175,80,.20);
    }

    .custom-card{
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,.08);
    }

    .table thead{
        background: #E8F5E9;
    }

    .table thead th{
        color: #2E7D32;
        font-weight: 700;
        border-bottom: none;
        white-space: nowrap;
    }

    .table tbody tr:hover{
        background: #F1F8E9;
        transition: .3s;
    }

    .btn-add{
        background: #4CAF50;
        border: none;
        color: white;
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: 600;
    }

    .btn-add:hover{
        background: #43A047;
        color: white;
    }

    .btn-detail{
        background: #26C6DA;
        color: white;
        border: none;
    }

    .btn-detail:hover{
        background: #00ACC1;
        color: white;
    }

    .btn-edit{
        background: #FFA726;
        color: white;
        border: none;
    }

    .btn-edit:hover{
        background: #FB8C00;
        color: white;
    }

    .btn-delete{
        background: #EF5350;
        color: white;
        border: none;
    }

    .btn-delete:hover{
        background: #E53935;
        color: white;
    }

    .badge-number{
        background: #E8F5E9;
        color: #2E7D32;
        padding: 8px 12px;
        border-radius: 50px;
        font-weight: 600;
    }

    .action-group{
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    @media(max-width:768px){

        .page-header{
            text-align:center;
        }

        .action-group{
            flex-direction: column;
        }

        .action-group .btn{
            width:100%;
        }
    }
</style>

{{-- HEADER --}}
<div class="page-header">

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h3 class="fw-bold mb-1">
                🌱 Kategori Produk
            </h3>

            <p class="mb-0">
                Kelola data kategori produk pertanian
            </p>
        </div>

        @if(auth()->user()->hasPermission('create.kategori-produk'))

        <a href="{{ route('admin.kategori-produk.create') }}"
           class="btn btn-add mt-2 mt-md-0">

            <i class="fas fa-plus-circle me-2"></i>
            Tambah Kategori

        </a>

        @endif

    </div>

</div>

{{-- CARD --}}
<div class="card custom-card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>
                        <th width="80">No</th>
                        <th>Nama Kategori</th>
                        <th width="280">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($kategoris as $kategori)

                    <tr>

                        <td>
                            <span class="badge-number">
                                {{ $loop->iteration }}
                            </span>
                        </td>

                        <td class="fw-semibold">
                            {{ $kategori->nama_kategori }}
                        </td>

                        <td>

                            <div class="action-group">

                                <a href="{{ route('admin.kategori-produk.show',$kategori) }}"
                                   class="btn btn-detail btn-sm rounded-pill">

                                    <i class="fas fa-eye"></i>
                                    Lihat

                                </a>

                                <a href="{{ route('admin.kategori-produk.edit',$kategori) }}"
                                   class="btn btn-edit btn-sm rounded-pill">

                                    <i class="fas fa-edit"></i>
                                    Edit

                                </a>

                                <form action="{{ route('admin.kategori-produk.destroy',$kategori) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                        class="btn btn-delete btn-sm rounded-pill">

                                        <i class="fas fa-trash"></i>
                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="3" class="text-center py-5">

                            <i class="fas fa-folder-open fa-3x text-success mb-3"></i>

                            <p class="text-muted mb-0">
                                Belum ada data kategori produk
                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection