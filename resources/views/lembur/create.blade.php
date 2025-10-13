@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body bg-light bg-gradient">
            <h5 class="fw-bold text-dark mb-1">
                <i class="fas fa-clock text-primary me-2"></i> Tambah Tarif Lembur
            </h5>
            <p class="text-muted mb-0">Silakan isi informasi tarif lembur baru yang ingin ditambahkan.</p>
        </div>
    </div>

    <!-- Alert Validation -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-exclamation-circle me-1"></i>Terjadi kesalahan!</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('lembur.store') }}" method="POST">
                @csrf

                <!-- Tarif Lembur -->
                <div class="mb-3 row">
                    <label for="tarif" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Tarif Lembur</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <input 
                            type="number" 
                            id="tarif" 
                            name="tarif" 
                            class="form-control @error('tarif') is-invalid @enderror" 
                            value="{{ old('tarif') }}" 
                            placeholder="Masukkan tarif lembur per jam..."
                            required
                        >
                        @error('tarif')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tombol -->
                <div class="row">
                    <div class="col-sm-9 offset-sm-2 text-end">
                        <a href="{{ route('lembur.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Tambah Tarif
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
