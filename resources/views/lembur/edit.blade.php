@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body bg-light bg-gradient">
            <h5 class="fw-bold text-dark mb-1">
                <i class="fas fa-edit me-2 text-primary"></i> Edit Tarif Lembur
            </h5>
            <p class="text-muted mb-0">Perbarui tarif lembur sesuai kebijakan perusahaan.</p>
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

    <!-- Form -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('lembur.update', $lembur->id_lembur) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Tarif Lembur --}}
                <div class="mb-4 row">
                    <label for="tarif" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Tarif Lembur</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="number" id="tarif" name="tarif" min="0"
                            class="form-control @error('tarif') is-invalid @enderror"
                            value="{{ old('tarif', $lembur->tarif) }}" required
                            placeholder="Masukkan tarif lembur...">
                        @error('tarif')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="row">
                    <div class="col-sm-9 offset-sm-2 text-end">
                        <a href="{{ route('lembur.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
