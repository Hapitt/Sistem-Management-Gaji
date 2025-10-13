@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="fas fa-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

    <!-- 4 CARD -->
    <div class="container mt-4">
        <div class="row text-center g-4">
            <div class="col-md-3">
                <div class="card shadow p-3">
                    <h5 class="mt-2">Total Karyawan</h5>
                    <p class="fw-bold fs-4">{{ $totalKaryawan }} Orang</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow p-3">
                    <h5 class="mt-2">Total Jabatan</h5>
                    <p class="fw-bold fs-4">{{ $totalJabatan }} Jabatan</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow p-3">
                    <h5 class="mt-2">Total Gaji Dibayarkan</h5>
                    <p class="fw-bold fs-5">Rp {{ number_format($totalGaji, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow p-3">
                    <h5 class="mt-2">Total Lembur</h5>
                    <p class="fw-bold fs-4">{{ $totalLembur }} Jam</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 2 CHART -->
    <div class="row mt-5">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-chart-area me-1"></i> Kinerja Karyawan</div>
                <div class="card-body"><canvas id="kinerjaKaryawanChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header"><i class="fas fa-chart-line me-1"></i> Pendapatan Perusahaan</div>
                <div class="card-body"><canvas id="pendapatanChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>

    <!-- 🔹 TABEL KARYAWAN TERBARU -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-users me-1"></i>
                Karyawan Terbaru
            </div>
            <div class="text-muted small">
                Menampilkan {{ $karyawans->firstItem() ?? 0 }} - {{ $karyawans->lastItem() ?? 0 }} dari {{ $karyawans->total() }} karyawan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Divisi</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($karyawans as $k)
                            <tr class="align-middle">
                                <td class="fw-semibold">{{ $k->nama }}</td>
                                <td>{{ $k->divisi }}</td>
                                <td>{{ $k->umur }}</td>
                                <td>
                                    @if($k->jenis_kelamin == 'Laki-laki')
                                        <span class="badge bg-primary">Laki-laki</span>
                                    @else
                                        <span class="badge bg-danger">Perempuan</span>
                                    @endif
                                </td>
                                <td class="text-truncate" style="max-width: 200px;" title="{{ $k->alamat }}">
                                    {{ $k->alamat }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-3 text-muted">Tidak ada data karyawan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            @if($karyawans->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-3">
                
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        {{-- Previous Page Link --}}
                        @if ($karyawans->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $karyawans->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($karyawans->getUrlRange(1, $karyawans->lastPage()) as $page => $url)
                            @if ($page == $karyawans->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($karyawans->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $karyawans->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agus', 'Sep', 'Okt'];
    const kinerjaData = [80, 75, 82, 80, 85, 88, 90, 80, 92, 95];
    const pendapatanData = [12000000, 15000000, 13000000, 17000000, 19000000, 21000000, 25000000, 30000000, 32000000, 35000000];

    new Chart(document.getElementById('kinerjaKaryawanChart'), {
        type: 'line',
        data: {
            labels: bulan,
            datasets: [{
                label: 'Persentase Kinerja (%)',
                data: kinerjaData,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true, max: 100 } } }
    });

    new Chart(document.getElementById('pendapatanChart'), {
        type: 'line',
        data: {
            labels: bulan,
            datasets: [{
                label: 'Total Pendapatan (Rp)',
                data: pendapatanData,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'Rp ' + value.toLocaleString('id-ID')
                    }
                }
            }
        }
    });
});
</script>
@endpush