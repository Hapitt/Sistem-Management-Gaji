<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Rating;
use App\Models\Gaji;
use App\Models\Lembur;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return redirect()->back()->with('warning', 'Masukkan kata kunci pencarian!');
        }

        // Pencarian berdasarkan kolom yang sesuai di ERD
        $karyawan = Karyawan::where('nama', 'like', "%{$query}%")
            ->orWhere('divisi', 'like', "%{$query}%")
            ->orWhere('status', 'like', "%{$query}%")
            ->get();

        $jabatan = Jabatan::where('jabatan', 'like', "%{$query}%")
            ->orWhere('gaji_pokok', 'like', "%{$query}%")
            ->orWhere('tunjangan', 'like', "%{$query}%")
            ->get();

        $rating = Rating::where('rating', 'like', "%{$query}%")
            ->orWhere('presentase_bonus', 'like', "%{$query}%")
            ->get();

        $lembur = Lembur::where('tarif', 'like', "%{$query}%")->get();

        $gaji = Gaji::where('periode', 'like', "%{$query}%")
            ->orWhere('total_pendapatan', 'like', "%{$query}%")
            ->get();

        return view('search.results', compact('query', 'karyawan', 'jabatan', 'rating', 'lembur', 'gaji'));
    }
}
