@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-3 overflow-hidden animate__animated animate__fadeIn">
        <div class="row g-0">
            <!-- FOTO KARYAWAN -->
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

            <!-- DETAIL GAJI -->
            <div class="col-md-8 bg-light">
                <div class="card-body p-5">
                    <h4 class="fw-bold text-primary mb-4 border-bottom pb-2">
                        <i class="fas fa-money-bill-wave me-2"></i> Detail Gaji Karyawan
                    </h4>

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border">
                                <span class="text-muted d-block mb-1">ID Gaji</span>
                                <span class="fw-semibold">{{ $gaji->id_gaji }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border">
                                <span class="text-muted d-block mb-1">Periode</span>
                                <span class="fw-semibold">{{ \Carbon\Carbon::parse($gaji->periode)->translatedFormat('F Y') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border">
                                <span class="text-muted d-block mb-1">Gaji Pokok</span>
                                <span class="fw-semibold text-success">Rp{{ number_format($gaji->karyawan->jabatan->gaji_pokok ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border">
                                <span class="text-muted d-block mb-1">Tunjangan</span>
                                <span class="fw-semibold text-success">Rp{{ number_format($gaji->karyawan->jabatan->tunjangan ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border">
                                <span class="text-muted d-block mb-1">Rating & Bonus</span>
                                <span class="fw-semibold">
                                    {{ $gaji->karyawan->rating->rating ?? '-' }} 
                                    ({{ ($gaji->karyawan->rating->presentase_bonus ?? 0) * 100 }}%)
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border">
                                <span class="text-muted d-block mb-1">Tarif Lembur</span>
                                <span class="fw-semibold text-primary">Rp{{ number_format($gaji->lembur->tarif ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border">
                                <span class="text-muted d-block mb-1">Lama Lembur</span>
                                <span class="fw-semibold">{{ $gaji->lama_lembur }} Jam</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border">
                                <span class="text-muted d-block mb-1">Total Lembur</span>
                                <span class="fw-semibold text-success">Rp{{ number_format($gaji->total_lembur, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border">
                                <span class="text-muted d-block mb-1">Total Bonus</span>
                                <span class="fw-semibold text-success">Rp{{ number_format($gaji->total_bonus, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm border">
                                <span class="text-muted d-block mb-1">Total Tunjangan</span>
                                <span class="fw-semibold text-success">Rp{{ number_format($gaji->total_tunjangan, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 bg-white rounded shadow-sm border border-2 border-primary">
                                <span class="text-muted d-block mb-1 fs-6">Total Pendapatan</span>
                                <span class="fw-bold text-primary fs-5">Rp{{ number_format($gaji->total_pendapatan, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-end">
                        <a href="{{ route('gaji.index') }}" class="btn btn-outline-primary px-4 py-2">
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
