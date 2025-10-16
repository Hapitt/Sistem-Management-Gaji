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
        @if(request('periode'))
            <div class="alert alert-info shadow-sm mt-3 mb-0">
                <i class="fas fa-calendar-alt me-2"></i> 
                Menampilkan gaji untuk periode: 
                <strong>{{ date('F Y', strtotime(request('periode') . '-01')) }}</strong>
            </div>
        @endif

        <div class="card border-0 shadow-sm mb-4 bg-light bg-gradient">
            <div class="card-body d-flex flex-wrap justify-content-between align-items-center p-4">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1">
                        <i class="fas fa-money-bill-wave me-2 text-primary"></i> Daftar Gaji Karyawan
                    </h1>
                    <p class="text-muted mb-0">
                        Kelola dan pantau seluruh data gaji karyawan perusahaan secara mudah & efisien.
                    </p>
                </div>
                <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
                    <!-- Search Bar -->
                    <form action="{{ route('gaji.index') }}" method="GET" class="d-flex">
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control rounded-start-pill shadow-sm" 
                            placeholder="Cari Nama Karyawan..." 
                            value="{{ request('search') }}"
                        >
                        <input 
                            type="month" 
                            name="periode" 
                            class="form-control shadow-sm"
                            value="{{ request('periode') }}"
                            title="Filter berdasarkan periode"
                        >

                        <button type="submit" class="btn btn-primary rounded-end-pill shadow-sm">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    
                    <!-- Add Button -->
                    <a href="{{ route('gaji.calculate') }}" class="btn btn-primary shadow-sm rounded-pill px-4">
                        <i class="fas fa-plus me-2"></i>Hitung
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
                            <th class="ps-4">No</th>
                            <th>Nama Karyawan</th>
                            <th>Lembur</th>
                            <th>Periode</th>
                            <th>Lama Lembur</th>
                            <th>Total Lembur</th>
                            <th>Total Bonus</th>
                            <th>Total Tunjangan</th>
                            <th>Total Pendapatan</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gaji as $index => $row)
                            <tr class="align-middle">
                                <td class="ps-4 fw-medium">{{ $gaji->firstItem() + $index }}</td>
                                <td><span class="fw-semibold">{{ $row->karyawan->nama ?? '-' }}</span></td>
                                <td><span class="badge bg-primary">Rp {{ number_format($row->lembur->tarif ?? 0, 0, ',', '.') }}</span></td>
                                <td><span class="badge bg-info text-dark">{{ $row->periode }}</span></td>
                                <td><span class="badge bg-warning text-dark">{{ $row->lama_lembur }} jam</span></td>
                                <td class="fw-semibold text-success">Rp {{ number_format($row->total_lembur, 0, ',', '.') }}</td>
                                <td class="fw-semibold text-info">Rp {{ number_format($row->total_bonus, 0, ',', '.') }}</td>
                                <td class="fw-semibold text-primary">Rp {{ number_format($row->total_tunjangan, 0, ',', '.') }}</td>
                                <td class="fw-bold text-success fs-6">Rp {{ number_format($row->total_pendapatan, 0, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('gaji.show', $row->id_gaji) }}" class="btn btn-sm btn-outline-primary" title="Detail"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('gaji.edit', $row->id_gaji) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('gaji.destroy', $row->id_gaji) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data gaji ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a href="{{ route('gaji.cetak', $row->id_gaji) }}" class="btn btn-sm btn-outline-success" title="Cetak Struk PDF"><i class="fas fa-file-pdf"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Tidak ada data gaji untuk periode atau pencarian tersebut.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

   <div class="d-flex justify-content-between align-items-center mt-3">
    <div class="text-muted">
        Menampilkan {{ $gaji->count() }} dari total {{ $gaji->total() }} Gaji Karyawan
    </div>
    <div>
        {{ $gaji->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection