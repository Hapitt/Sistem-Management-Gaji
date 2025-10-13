@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body bg-light bg-gradient">
            <h5 class="fw-bold text-dark mb-1">
                <i class="fas fa-user-plus me-2 text-primary"></i> Tambah Karyawan
            </h5>
            <p class="text-muted mb-0">Silakan isi informasi karyawan baru yang ingin ditambahkan.</p>
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
            <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Jabatan --}}
                <div class="mb-3 row">
                    <label for="id_jabatan" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Jabatan</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <select class="form-select @error('id_jabatan') is-invalid @enderror" 
                                id="id_jabatan" name="id_jabatan" required>
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach($jabatans as $jabatan)
                                <option value="{{ $jabatan->id_jabatan }}" {{ old('id_jabatan') == $jabatan->id_jabatan ? 'selected' : '' }}>
                                    {{ $jabatan->jabatan }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Rating --}}
                <div class="mb-3 row">
                    <label for="id_jabatan" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Rating</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <select class="form-select @error('id_rating') is-invalid @enderror" 
                                id="id_rating" name="id_rating" required>
                            <option value="">-- Pilih Rating --</option>
                            @foreach($ratings as $rating)
                                <option value="{{ $rating->id_rating }}" {{ old('id_rating') == $rating->id_rating ? 'selected' : '' }}>
                                    {{ $rating->rating }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Nama --}}
                <div class="mb-3 row">
                    <label for="id_jabatan" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Nama Karyawan</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Divisi --}}
                <div class="mb-3 row">
                    <label for="id_jabatan" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Divisi</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('divisi') is-invalid @enderror" 
                               id="divisi" name="divisi" value="{{ old('divisi') }}" required>
                        @error('divisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="mb-3 row">
<label for="id_jabatan" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Alamat</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                  id="alamat" name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Umur --}}
                <div class="mb-3 row">
                    <label for="id_jabatan" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Umur</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control @error('umur') is-invalid @enderror" 
                               id="umur" name="umur" value="{{ old('umur') }}" required>
                        @error('umur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Jenis Kelamin --}}
                <div class="mb-3 row">
                    <label for="id_jabatan" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Jenis Kelamin</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki"
                                   class="form-check-input" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required>
                            <label for="laki" class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan"
                                   class="form-check-input" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required>
                            <label for="perempuan" class="form-check-label">Perempuan</label>
                        </div>
                        @error('jenis_kelamin')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Status --}}
                <div class="mb-3 row">
                    <label for="id_jabatan" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Status</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Foto --}}
                <div class="mb-4 row">
                    <label for="id_jabatan" class="col-sm-2 col-form-label fw-semibold d-flex justify-content-between">
                        <span>Foto (Uk 4:3)</span><span>:</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                               id="foto" name="foto" accept="image/*">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="row">
                    <div class="col-sm-9 offset-sm-2 text-end">
                        <a href="{{ route('karyawan.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Simpan Karyawan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
