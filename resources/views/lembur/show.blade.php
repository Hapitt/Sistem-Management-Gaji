@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="card border shadow-sm rounded-3 overflow-hidden animate__animated animate__fadeIn">
        <!-- Header -->
        <div class="bg-primary bg-gradient text-white p-4">
            <h3 class="fw-bold mb-1">
                <i class="fas fa-clock me-2"></i> Tarif Lembur #{{ $lembur->id_lembur }}
            </h3>
            <small class="text-white-50">Detail informasi tarif lembur</small>
        </div>

        <!-- Body -->
        <div class="card-body bg-light">
            <h5 class="fw-semibold mb-4 text-primary border-bottom pb-2">
                <i class="fas fa-info-circle me-2"></i> Informasi Lembur
            </h5>

            <div class="row gy-3">
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow-sm border">
                        <span class="text-muted d-block mb-1">ID Lembur</span>
                        <span class="fw-semibold">{{ $lembur->id_lembur }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow-sm border">
                        <span class="text-muted d-block mb-1">Tarif Lembur</span>
                        <span class="fw-semibold text-success">Rp {{ number_format($lembur->tarif, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow-sm border">
                        <span class="text-muted d-block mb-1">Tanggal Dibuat</span>
                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($lembur->created_at)->translatedFormat('d F Y, H:i') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow-sm border">
                        <span class="text-muted d-block mb-1">Terakhir Diperbarui</span>
                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($lembur->updated_at)->translatedFormat('d F Y, H:i') }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href="{{ route('lembur.index') }}" class="btn btn-outline-primary px-4">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Animate.css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
