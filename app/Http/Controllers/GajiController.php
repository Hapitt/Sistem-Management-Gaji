<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Lembur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class GajiController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $periode = $request->input('periode');

        $gaji = Gaji::with(['karyawan', 'lembur'])
            ->when($search, function ($query, $search) {
                $query->whereHas('karyawan', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->when($periode, function ($query, $periode) {
                $bulan = date('m', strtotime($periode . '-01'));
                $tahun = date('Y', strtotime($periode . '-01'));
                $query->whereMonth('periode', $bulan)->whereYear('periode', $tahun);
            })

            ->orderBy('id_gaji', 'asc')
            ->get();

        return view('gaji.index', compact('gaji', 'search', 'periode'));
    }



    public function calculate()
    {
        $karyawan = Karyawan::all();
        $lembur = Lembur::all();
        return view('gaji.calculate', compact('karyawan', 'lembur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'id_lembur' => 'required|exists:lembur,id_lembur',
            'periode' => 'required|date',
            'lama_lembur' => 'required|integer',
        ]);

        // Ambil data karyawan lengkap beserta jabatan & rating
        $karyawan = DB::table('karyawan')
            ->join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
            ->join('rating', 'karyawan.id_rating', '=', 'rating.id_rating')
            ->where('karyawan.id_karyawan', $request->id_karyawan)
            ->select('jabatan.gaji_pokok', 'jabatan.tunjangan', 'rating.presentase_bonus')
            ->first();

        // Ambil data lembur
        $lembur = DB::table('lembur')->where('id_lembur', $request->id_lembur)->first();

        if (!$karyawan || !$lembur) {
            return back()->withErrors(['msg' => 'Data karyawan atau lembur tidak ditemukan.']);
        }

        // Proses hitung gaji
        $gaji_pokok = $karyawan->gaji_pokok;
        $tunjangan = $karyawan->tunjangan;
        $presentase_bonus = $karyawan->presentase_bonus;
        $tarif_lembur = $lembur->tarif;

        $total_lembur = $request->lama_lembur * $tarif_lembur;
        $total_bonus = $gaji_pokok * $presentase_bonus;
        $total_tunjangan = $tunjangan;
        $total_pendapatan = $gaji_pokok + $total_lembur + $total_bonus + $total_tunjangan;

        // Simpan hasil ke tabel gaji
        Gaji::create([
            'id_karyawan' => $request->id_karyawan,
            'id_lembur' => $request->id_lembur,
            'lama_lembur' => $request->lama_lembur,
            'periode' => $request->periode,
            'total_lembur' => $total_lembur,
            'total_bonus' => $total_bonus,
            'total_tunjangan' => $total_tunjangan,
            'total_pendapatan' => $total_pendapatan,
        ]);

        return redirect()->route('gaji.index')->with('success', 'Gaji berhasil dihitung dan disimpan.');
    }


    public function show($id)
    {
        $gaji = Gaji::with(['karyawan', 'lembur'])->findOrFail($id);
        return view('gaji.show', compact('gaji'));
    }

    public function edit($id)
    {
        $gaji = Gaji::findOrFail($id);
        $karyawan = Karyawan::all();
        $lembur = Lembur::all();
        return view('gaji.edit', compact('gaji', 'karyawan', 'lembur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'id_lembur' => 'required|exists:lembur,id_lembur',
            'periode' => 'required|date',
            'lama_lembur' => 'required|integer|min:0',
        ]);

        $gaji = Gaji::findOrFail($id);

        // 🔹 Ambil data karyawan lengkap (gaji pokok, tunjangan, bonus)
        $karyawan = DB::table('karyawan')
            ->join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
            ->join('rating', 'karyawan.id_rating', '=', 'rating.id_rating')
            ->where('karyawan.id_karyawan', $request->id_karyawan)
            ->select('jabatan.gaji_pokok', 'jabatan.tunjangan', 'rating.presentase_bonus')
            ->first();

        // 🔹 Ambil data lembur
        $lembur = DB::table('lembur')->where('id_lembur', $request->id_lembur)->first();

        if (!$karyawan || !$lembur) {
            return back()->withErrors(['msg' => 'Data karyawan atau lembur tidak ditemukan.']);
        }

        // 🔹 Hitung ulang semua nilai
        $gaji_pokok = $karyawan->gaji_pokok;
        $tunjangan = $karyawan->tunjangan;
        $presentase_bonus = $karyawan->presentase_bonus;
        $tarif_lembur = $lembur->tarif;

        $total_lembur = $request->lama_lembur * $tarif_lembur;
        $total_bonus = $gaji_pokok * $presentase_bonus;
        $total_tunjangan = $tunjangan;
        $total_pendapatan = $gaji_pokok + $total_lembur + $total_bonus + $total_tunjangan;

        // 🔹 Update ke database
        $gaji->update([
            'id_karyawan' => $request->id_karyawan,
            'id_lembur' => $request->id_lembur,
            'lama_lembur' => $request->lama_lembur,
            'periode' => $request->periode,
            'total_lembur' => $total_lembur,
            'total_bonus' => $total_bonus,
            'total_tunjangan' => $total_tunjangan,
            'total_pendapatan' => $total_pendapatan,
        ]);

        // 🔹 Redirect ke index dengan alert sukses
        return redirect()->route('gaji.index')->with('success', 'Gaji berhasil diperbarui dan dihitung ulang.');
    }


    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();
        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil dihapus');
    }

    // pastikan di atas

    public function cetak($id)
    {
        $gaji = Gaji::with(['karyawan', 'lembur'])->findOrFail($id);

        // Ambil data tambahan jika perlu, seperti jabatan & rating
        $karyawan = DB::table('karyawan')
            ->join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
            ->join('rating', 'karyawan.id_rating', '=', 'rating.id_rating')
            ->where('karyawan.id_karyawan', $gaji->id_karyawan)
            ->select(
                'karyawan.nama',
                'jabatan.jabatan as nama_jabatan',
                'jabatan.gaji_pokok',
                'jabatan.tunjangan',
                'rating.presentase_bonus',
                'rating.rating'
            )
            ->first();

        // Load view untuk struk PDF
        $pdf = Pdf::loadView('gaji.struk', compact('gaji', 'karyawan'))
            ->setPaper('A4', 'portrait');

        // Unduh file PDF
        return $pdf->download('Struk_Gaji_' . $karyawan->nama . '.pdf');
    }
}
