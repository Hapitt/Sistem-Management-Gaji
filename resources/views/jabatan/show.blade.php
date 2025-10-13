@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="card border shadow-sm rounded-3 overflow-hidden animate__animated animate__fadeIn">
        <!-- Header -->
        <div class="bg-primary bg-gradient text-white p-4">
            <h3 class="fw-bold mb-1">
                <i class="fas fa-briefcase me-2"></i> {{ $jabatan->jabatan }}
            </h3>
            <small class="text-white-50">Detail informasi jabatan</small>
        </div>

        <!-- Body -->
        <div class="card-body bg-light">
            <h5 class="fw-semibold mb-4 text-primary border-bottom pb-2">
                <i class="fas fa-info-circle me-2"></i> Informasi Jabatan
            </h5>

            <div class="row gy-3">
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow-sm border">
                        <span class="text-muted d-block mb-1">ID Jabatan</span>
                        <span class="fw-semibold">{{ $jabatan->id_jabatan }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow-sm border">
                        <span class="text-muted d-block mb-1">Nama Jabatan</span>
                        <span class="fw-semibold">{{ $jabatan->jabatan }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow-sm border">
                        <span class="text-muted d-block mb-1">Gaji Pokok</span>
                        <span class="fw-semibold text-success">Rp{{ number_format($jabatan->gaji_pokok, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow-sm border">
                        <span class="text-muted d-block mb-1">Tunjangan</span>
                        <span class="fw-semibold text-info">Rp{{ number_format($jabatan->tunjangan, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow-sm border">
                        <span class="text-muted d-block mb-1">Tanggal Dibuat</span>
                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($jabatan->created_at)->translatedFormat('d F Y, H:i') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow-sm border">
                        <span class="text-muted d-block mb-1">Terakhir Diperbarui</span>
                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($jabatan->updated_at)->translatedFormat('d F Y, H:i') }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href="{{ route('jabatan.index') }}" class="btn btn-outline-primary px-4">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Animate.css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
