@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body bg-light bg-gradient">
            <h5 class="fw-bold text-dark mb-1">
                <i class="fas fa-edit me-2 text-primary"></i> Edit Rating
            </h5>
            <p class="text-muted mb-0">Perbarui nilai rating dan presentase bonus sesuai kebutuhan perusahaan.</p>
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
            <form action="{{ route('rating.update', $rating->id_rating) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Rating --}}
                <div class="mb-3 row">
                    <label for="rating" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Rating</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" id="rating" name="rating"
                            class="form-control @error('rating') is-invalid @enderror"
                            value="{{ old('rating', $rating->rating) }}" required>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Presentase Bonus --}}
                <div class="mb-4 row">
                    <label for="presentase_bonus" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Presentase Bonus</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" id="presentase_bonus" name="presentase_bonus"
                            class="form-control @error('presentase_bonus') is-invalid @enderror"
                            value="{{ old('presentase_bonus', $rating->presentase_bonus) }}" required>
                        @error('presentase_bonus')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="row">
                    <div class="col-sm-9 offset-sm-2 text-end">
                        <a href="{{ route('rating.index') }}" class="btn btn-secondary me-2">
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
