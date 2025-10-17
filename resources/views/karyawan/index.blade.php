@extends('layouts.main')

@section('content')

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="container-fluid py-4 animate__animated animate__fadeIn">
        <!-- Alert Pencarian -->
        @if(request('search'))
            <div class="alert alert-info shadow-sm mb-3">
                <i class="fas fa-search me-2"></i> 
                Menampilkan hasil pencarian untuk: 
                <strong>{{ request('search') }}</strong>
            </div>
        @endif

        <!-- Header Section -->
        <div class="card border-0 shadow-sm mb-4 bg-light bg-gradient">
            <div class="card-body p-4">
                
                <div class="row align-items-center mb-4">
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <h1 class="h3 fw-bold text-dark mb-2">
                            <i class="fas fa-users me-2 text-primary"></i> Daftar Karyawan
                        </h1>
                        <p class="text-muted mb-0 fs-6">
                            Kelola dan pantau seluruh data karyawan perusahaan secara mudah & efisien.
                        </p>
                    </div>
                    
                    <!-- Action Buttons Section -->
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-lg-end">
                            <a href="{{ route('karyawan.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4 me-3 flex-shrink-0">
                                <i class="fas fa-plus me-2"></i> Tambah
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Search & Filter Section -->
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('karyawan.index') }}" method="GET" class="row g-3 align-items-end">
                            <!-- Search Bar -->
                            <div class="col-md-4 col-lg-3">
                                <label class="form-label small text-muted mb-1">Cari Karyawan</label>
                                <input 
                                    type="text" 
                                    name="search" 
                                    class="form-control shadow-sm" 
                                    placeholder="Nama karyawan..." 
                                    value="{{ request('search') }}"
                                >
                            </div>

                            <!-- Filter Jabatan -->
                            <div class="col-md-3 col-lg-3">
                                <label class="form-label small text-muted mb-1">Filter Jabatan</label>
                                <select name="jabatan" class="form-select shadow-sm">
                                    <option value="">Semua Jabatan</option>
                                    @foreach($jabatans as $j)
                                        <option value="{{ $j->id_jabatan }}" {{ (isset($filterJabatan) && $filterJabatan == $j->id_jabatan) ? 'selected' : '' }}>
                                            {{ $j->jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filter Rating -->
                            <div class="col-md-3 col-lg-2">
                                <label class="form-label small text-muted mb-1">Filter Rating</label>
                                <select name="rating" class="form-select shadow-sm">
                                    <option value="">Semua Rating</option>
                                    @foreach($ratings as $r)
                                        <option value="{{ $r->id_rating }}" {{ (isset($filterRating) && $filterRating == $r->id_rating) ? 'selected' : '' }}>
                                            {{ $r->rating }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-md-2 col-lg-2">
                                <button type="submit" class="btn btn-primary shadow-sm w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-search me-2"></i> Cari
                                </button>
                            </div>

                            <!-- Reset Button -->
                            <div class="col-md-2 col-lg-2">
                                <a href="{{ route('karyawan.index') }}" class="btn btn-outline-secondary shadow-sm w-100">
                                    <i class="fas fa-refresh me-2"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>
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
                            <th class="ps-4">Nama</th>
                            <th>Divisi</th>
                            <th>Jabatan</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($karyawans as $k)
                            <tr class="align-middle">
                                <td class="ps-4 fw-medium">{{ $k->nama }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $k->divisi }}</span>
                                </td>
                                <td>{{ $k->jabatan->jabatan ?? '-' }}</td>
                                <td class="text-truncate" style="max-width: 200px;" title="{{ $k->alamat }}">
                                    {{ $k->alamat }}
                                </td>
                                <td>
                                    @if($k->jenis_kelamin == 'Laki-laki')
                                        <span class="badge bg-primary">
                                            <i class="fas fa-mars me-1"></i> L
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-venus me-1"></i> P
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($k->status == 'Aktif')
                                        <span class="badge bg-success">{{ $k->status }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $k->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('karyawan.show', $k->id_karyawan) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('karyawan.edit', $k->id_karyawan) }}" 
                                           class="btn btn-sm btn-outline-warning" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('karyawan.destroy', $k->id_karyawan) }}" 
                                              method="POST" 
                                              class="d-inline" 
                                              onsubmit="return confirm('Yakin ingin menghapus?')">
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

            <div class="d-flex justify-content-between align-items-center mt-3 px-4 pb-3">
                <div class="text-muted">
                    Menampilkan {{ $karyawans->count() }} dari total {{ $karyawans->total() }} Karyawan
                </div>
                <div>
                    {{ $karyawans->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection