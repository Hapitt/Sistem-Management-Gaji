<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filterJabatan = $request->input('jabatan');
        $filterRating = $request->input('rating');

        // Ambil semua jabatan dan rating untuk select box
        $jabatans = Jabatan::all();
        $ratings = Rating::all();

        $karyawans = Karyawan::with(['jabatan', 'rating'])
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('divisi', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhereHas('jabatan', function ($q) use ($search) {
                        $q->where('jabatan', 'like', "%{$search}%");
                    });
            })
            ->when($filterJabatan, function ($query, $filterJabatan) {
                $query->where('id_jabatan', $filterJabatan);
            })
            ->when($filterRating, function ($query, $filterRating) {
                $query->where('id_rating', $filterRating);
            })
            ->paginate(5)
            ->withQueryString(); // agar filter tetap terbawa saat pagination

        return view('karyawan.index', compact('karyawans', 'search', 'jabatans', 'ratings', 'filterJabatan', 'filterRating'));
    }



    public function create()
    {
        $jabatans = Jabatan::all();
        $ratings = Rating::all();
        return view('karyawan.create', compact('jabatans', 'ratings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'id_rating' => 'required|exists:rating,id_rating',
            'nama' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'umur' => 'required|integer',
            'jenis_kelamin' => 'required|string',
            'status' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);


        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('uploads/karyawan', 'public');
            $validated['foto'] = $path;
        }

        Karyawan::create($validated);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function show($id)
    {
        $karyawan = Karyawan::with(['jabatan', 'rating'])->findOrFail($id);
        return view('karyawan.show', compact('karyawan'));
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $jabatans = Jabatan::all();
        $ratings = Rating::all();
        return view('karyawan.edit', compact('karyawan', 'jabatans', 'ratings'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $validated = $request->validate([
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'id_rating' => 'required|exists:rating,id_rating',
            'nama' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'umur' => 'required|integer',
            'jenis_kelamin' => 'required|string',
            'status' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);


        if ($request->hasFile('foto')) {
            if ($karyawan->foto && Storage::disk('public')->exists($karyawan->foto)) {
                Storage::disk('public')->delete($karyawan->foto);
            }
            $path = $request->file('foto')->store('uploads/karyawan', 'public');
            $validated['foto'] = $path;
        }

        $karyawan->update($validated);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        if ($karyawan->foto && Storage::disk('public')->exists($karyawan->foto)) {
            Storage::disk('public')->delete($karyawan->foto);
        }

        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
