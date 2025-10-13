@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-gradient bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i> Edit Profil</h5>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3 align-items-center">
                    <div class="col-md-3 text-center">
                        <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('images/default-avatar.png') }}"
                             alt="Profile" class="rounded-circle border shadow-sm" width="130" height="130"
                             style="object-fit: cover;">
                        <div class="mt-2">
                            <input type="file" name="foto" class="form-control form-control-sm">
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Username</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password Baru (Opsional)</label>
                            <input type="password" name="password" class="form-control" placeholder="Isi jika ingin mengganti password">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                        </div>

                        <div class="row">
                        <div class="col-sm-9 offset-sm-2 text-end">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Animasi Smooth --}}
<style>
.card {
    transition: all 0.3s ease-in-out;
}
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}
</style>
@endsection
