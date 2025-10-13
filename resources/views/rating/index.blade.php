@extends('layouts.main')

@section('content')
@vite(['resources/css/style.css'])

<div class="container-fluid py-4">
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
                        <i class="fas fa-star me-2 text-primary"></i> Daftar Rating
                    </h1>
                    <p class="text-muted mb-0">
                        Kelola dan pantau seluruh data rating kinerja karyawan perusahaan secara mudah & efisien.
                    </p>
                </div>
                <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
                    <!-- Search Bar -->
                    <form action="{{ route('rating.index') }}" method="GET" class="d-flex">
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control rounded-start-pill shadow-sm" 
                            placeholder="Cari Rating..." 
                            value="{{ request('search') }}"
                        >
                        <button type="submit" class="btn btn-primary rounded-end-pill shadow-sm">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    <!-- Add Button -->
                    <a href="{{ route('rating.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4">
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
                            <th class="ps-4">Rating</th>
                            <th>Presentase Bonus</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ratings as $row)
                            <tr class="align-middle">
                                <td class="ps-4 fw-medium">
                                    <span class="badge bg-primary text-light fs-6">
                                        {{ $row->rating }} ⭐
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-success fs-6">
                                        {{ $row->presentase_bonus * 100 }}%
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('rating.show', $row->id_rating) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('rating.edit', $row->id_rating) }}" 
                                           class="btn btn-sm btn-outline-warning" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('rating.destroy', $row->id_rating) }}" 
                                              method="POST" 
                                              class="d-inline" 
                                              onsubmit="return confirm('Yakin ingin menghapus rating ini?')">
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
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-star fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">Belum ada data rating</p>
                                        <a href="{{ route('rating.create') }}" class="btn btn-primary btn-sm mt-2">
                                            Tambah Rating Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Info Jumlah Data -->
    <div class="mt-3 text-muted">
        Menampilkan {{ count($ratings) }} rating
    </div>
</div>
@endsection