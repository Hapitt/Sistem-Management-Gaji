@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="card border border-1 shadow rounded-2 overflow-hidden animate__animated animate__fadeIn">
        <div class="row g-0">
            <!-- FOTO PROFIL -->
            <div class="col-md-4 bg-primary bg-gradient text-white d-flex flex-column align-items-center justify-content-center p-4">
                <div class="position-relative">
                    <img src="{{ $karyawan->foto ? asset('storage/'.$karyawan->foto) : asset('Logo.png') }}"
                        alt="Foto Karyawan"
                        class="rounded-circle border border-2 border-white shadow-sm"
                        style="width: 180px; height: 180px; object-fit: cover;">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success shadow-sm">
                        {{ $karyawan->status }}
                    </span>
                </div>
                <h4 class="mt-4 fw-bold">{{ $karyawan->nama }}</h4>
                <p class="mb-1 text-white-50">{{ $karyawan->jabatan->jabatan ?? '-' }}</p>
                <p class="text-white-50 mb-0">{{ $karyawan->divisi }}</p>
            </div>

            <!-- DETAIL KARYAWAN -->
            <div class="col-md-8 bg-light">
                <div class="card-body p-5">
                    <h4 class="fw-bold mb-4 text-primary border-bottom pb-2">
                        <i class="fas fa-id-card me-2"></i> Detail Karyawan
                    </h4>

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border border-1">
                                <span class="text-muted d-block mb-1">ID Karyawan</span>
                                <span class="fw-semibold">{{ $karyawan->id_karyawan }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border border-1">
                                <span class="text-muted d-block mb-1">Nama</span>
                                <span class="fw-semibold">{{ $karyawan->nama }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border border-1">
                                <span class="text-muted d-block mb-1">Divisi</span>
                                <span class="fw-semibold">{{ $karyawan->divisi }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border border-1">
                                <span class="text-muted d-block mb-1">Jabatan</span>
                                <span class="fw-semibold">{{ $karyawan->jabatan->jabatan ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border border-1">
                                <span class="text-muted d-block mb-1">Rating</span>
                                <span class="badge bg-info fs-6">{{ $karyawan->rating->rating ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border border-1">
                                <span class="text-muted d-block mb-1">Umur</span>
                                <span class="fw-semibold">{{ $karyawan->umur }} Tahun</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border border-1">
                                <span class="text-muted d-block mb-1">Jenis Kelamin</span>
                                <span class="fw-semibold">{{ $karyawan->jenis_kelamin }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border border-1">
                                <span class="text-muted d-block mb-1">Tanggal Bergabung</span>
                                <span class="fw-semibold">{{ \Carbon\Carbon::parse($karyawan->created_at)->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 bg-white rounded shadow-sm border border-1">
                                <span class="text-muted d-block mb-1">Alamat</span>
                                <span class="fw-semibold">{{ $karyawan->alamat }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <a href="{{ route('karyawan.index') }}" class="btn btn-outline-primary px-4">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Animate.css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
