@extends('layouts.main')

@section('content')
@vite(['resources/css/style.css'])

<div class="container-fluid py-4">
    <!-- Header -->
<!-- Header -->
    <div class="container-fluid py-4 animate__animated animate__fadeIn">
    <!-- Header Section -->
        @if(request('search'))
            <div class="alert alert-info shadow-sm mt-3 mb-0">
                <i class="fas fa-search me-2"></i> 
                Menampilkan hasil pencarian untuk: 
                <strong>{{ request('search') }}</strong>
            </div>
        @endif
        <div class="card border-0 shadow-sm mb-4 bg-light bg-gradient">
            <div class="card-body d-flex flex-wrap justify-content-between align-items-center p-4">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1">
                        <i class="fas fa-briefcase me-2 text-primary"></i> Daftar Jabatan
                    </h1>
                    <p class="text-muted mb-0">
                        Kelola dan pantau seluruh data jabatan perusahaan secara mudah & efisien.
                    </p>
                </div>
                <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
                    <!-- Search Bar -->
                    <form action="{{ route('jabatan.index') }}" method="GET" class="d-flex">
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control rounded-start-pill shadow-sm" 
                            placeholder="Cari Jabatan..." 
                            value="{{ request('search') }}"
                        >
                        <button type="submit" class="btn btn-primary rounded-end-pill shadow-sm">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    <!-- Add Button -->
                    <a href="{{ route('jabatan.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4">
                        <i class="fas fa-plus me-2"></i>Tambah
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Jabatan</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jabatans as $row)
                            <tr class="align-middle">
                                <td class="ps-4 fw-medium">{{ $row->jabatan }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        Rp{{ number_format($row->gaji_pokok, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        Rp{{ number_format($row->tunjangan, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('jabatan.show', $row->id_jabatan) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('jabatan.edit', $row->id_jabatan) }}" 
                                           class="btn btn-sm btn-outline-warning" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('jabatan.destroy', $row->id_jabatan) }}" 
                                              method="POST" 
                                              class="d-inline" 
                                              onsubmit="return confirm('Yakin ingin menghapus jabatan {{ $row->jabatan }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
    <div class="text-muted">
        Menampilkan {{ $jabatans->count() }} dari total {{ $jabatans->total() }} jabatan
    </div>
    <div>
        {{ $jabatans->links('pagination::bootstrap-5') }}
    </div>
</div>
</div>

@endsection