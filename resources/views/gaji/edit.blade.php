@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body bg-light bg-gradient">
            <h5 class="fw-bold text-dark mb-1">
                <i class="fas fa-edit me-2 text-primary"></i> Edit Gaji Karyawan
            </h5>
            <p class="text-muted mb-0">Perbarui data perhitungan gaji karyawan berikut dengan benar.</p>
        </div>
    </div>

    <!-- Alert Error -->
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

    <!-- Form Edit -->
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden animate__animated animate__fadeIn">
        <div class="row g-0">
            <!-- Foto Karyawan -->
            <div class="col-md-4 bg-primary bg-gradient text-white d-flex flex-column align-items-center justify-content-center p-4">
                <div class="position-relative">
                    <img src="{{ $gaji->karyawan->foto ? asset('storage/'.$gaji->karyawan->foto) : asset('Logo.png') }}"
                        alt="Foto Karyawan"
                        class="rounded-circle border border-3 border-white shadow-sm"
                        style="width: 200px; height: 200px; object-fit: cover;">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success shadow-sm">
                        {{ $gaji->karyawan->status }}
                    </span>
                </div>
                <h4 class="mt-4 fw-bold">{{ $gaji->karyawan->nama }}</h4>
                <p class="mb-0 text-white-50">{{ $gaji->karyawan->jabatan->jabatan ?? '-' }}</p>
                <p class="text-white-50">{{ $gaji->karyawan->divisi ?? '-' }}</p>
            </div>

            <!-- Form Edit Gaji -->
            <div class="col-md-8 bg-white">
                <div class="card-body p-5">
                    <form action="{{ route('gaji.update', $gaji->id_gaji) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Karyawan --}}
                        <div class="mb-3 row">
                            <label for="id_karyawan" class="col-sm-3 col-form-label fw-semibold d-flex justify-content-between">
                                <span>Karyawan</span><span>:</span>
                            </label>
                            <div class="col-sm-8">
                                <select name="id_karyawan" id="id_karyawan"
                                    class="form-select @error('id_karyawan') is-invalid @enderror" required>
                                    <option value="">-- Pilih Karyawan --</option>
                                    @foreach ($karyawan as $k)
                                        <option value="{{ $k->id_karyawan }}"
                                            {{ old('id_karyawan', $gaji->id_karyawan) == $k->id_karyawan ? 'selected' : '' }}>
                                            {{ $k->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_karyawan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tarif Lembur --}}
                        <div class="mb-3 row">
                            <label for="id_lembur" class="col-sm-3 col-form-label fw-semibold d-flex justify-content-between">
                                <span>Tarif Lembur</span><span>:</span>
                            </label>
                            <div class="col-sm-8">
                                <select name="id_lembur" id="id_lembur"
                                    class="form-select @error('id_lembur') is-invalid @enderror" required>
                                    <option value="">-- Pilih Tarif --</option>
                                    @foreach ($lembur as $l)
                                        <option value="{{ $l->id_lembur }}"
                                            {{ old('id_lembur', $gaji->id_lembur) == $l->id_lembur ? 'selected' : '' }}>
                                            Rp{{ number_format($l->tarif, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_lembur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Lama Lembur --}}
                        <div class="mb-3 row">
                            <label for="lama_lembur" class="col-sm-3 col-form-label fw-semibold d-flex justify-content-between">
                                <span>Lama Lembur</span><span>:</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="number" id="lama_lembur" name="lama_lembur"
                                    class="form-control @error('lama_lembur') is-invalid @enderror"
                                    value="{{ old('lama_lembur', $gaji->lama_lembur) }}" required>
                                @error('lama_lembur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Periode --}}
                        <div class="mb-3 row">
                            <label for="periode" class="col-sm-3 col-form-label fw-semibold d-flex justify-content-between">
                                <span>Periode</span><span>:</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="date" id="periode" name="periode"
                                    class="form-control @error('periode') is-invalid @enderror"
                                    value="{{ old('periode', $gaji->periode) }}" required>
                                @error('periode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Totalan (Hidden / bisa ditampilkan kalau mau review) --}}
                        <input type="hidden" name="total_lembur" value="{{ $gaji->total_lembur }}">
                        <input type="hidden" name="total_bonus" value="{{ $gaji->total_bonus }}">
                        <input type="hidden" name="total_tunjangan" value="{{ $gaji->total_tunjangan }}">
                        <input type="hidden" name="total_pendapatan" value="{{ $gaji->total_pendapatan }}">

                        {{-- Tombol Aksi --}}
                        <div class="row mt-4">
                            <div class="col-sm-8 offset-sm-3 text-end">
                                <a href="{{ route('gaji.index') }}" class="btn btn-secondary me-2">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Animate.css for smooth effect --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
