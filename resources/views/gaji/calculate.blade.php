@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body bg-light bg-gradient">
            <h5 class="fw-bold text-dark mb-1">
                <i class="fas fa-calculator text-primary me-2"></i> Hitung Gaji Karyawan
            </h5>
            <p class="text-muted mb-0">Silakan isi data berikut untuk menghitung dan menyimpan gaji karyawan.</p>
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
            <form action="{{ route('gaji.store') }}" method="POST">
                @csrf

                <!-- Karyawan -->
                <div class="mb-3 row">
                    <label for="id_karyawan" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Karyawan</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <select name="id_karyawan" id="id_karyawan" 
                                class="form-select @error('id_karyawan') is-invalid @enderror" required>
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach ($karyawan as $k)
                                <option value="{{ $k->id_karyawan }}" {{ old('id_karyawan') == $k->id_karyawan ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_karyawan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tarif Lembur -->
                <div class="mb-3 row">
                    <label for="id_lembur" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Tarif Lembur</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <select name="id_lembur" id="id_lembur" 
                                class="form-select @error('id_lembur') is-invalid @enderror" required>
                            <option value="">-- Pilih Tarif Lembur --</option>
                            @foreach ($lembur as $l)
                                <option value="{{ $l->id_lembur }}" {{ old('id_lembur') == $l->id_lembur ? 'selected' : '' }}>
                                    Rp {{ number_format($l->tarif, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_lembur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Lama Lembur -->
                <div class="mb-3 row">
                    <label for="lama_lembur" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Lama Lembur (jam)</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="number" id="lama_lembur" name="lama_lembur"
                            class="form-control @error('lama_lembur') is-invalid @enderror"
                            value="{{ old('lama_lembur') }}" required placeholder="Masukkan jumlah jam lembur...">
                        @error('lama_lembur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Periode -->
                <div class="mb-3 row">
                    <label for="periode" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Periode</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="date" id="periode" name="periode"
                            class="form-control @error('periode') is-invalid @enderror"
                            value="{{ old('periode') }}" required>
                        @error('periode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tombol -->
                <div class="row">
                    <div class="col-sm-9 offset-sm-2 text-end">
                        <a href="{{ route('gaji.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-calculator me-2"></i> Hitung & Simpan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
