<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Gaji;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        $karyawans = Karyawan::latest()->paginate(5);

        $totalKaryawan = Karyawan::count();
        $totalJabatan = Jabatan::count();
        $totalLembur = Gaji::sum('lama_lembur') ?? 0;
        $totalGaji = Gaji::sum('total_pendapatan') ?? 0;

        return view('dashboard', compact(
            'totalKaryawan',
            'totalJabatan',
            'totalLembur',
            'totalGaji',
            'karyawans'
        ));
    }
}
