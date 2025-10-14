<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // ambil input pencarian

        $jabatans = Jabatan::when($search, function ($query, $search) {
            $query->where('jabatan', 'like', "%{$search}%")
                ->orWhere('gaji_pokok', 'like', "%{$search}%")
                ->orWhere('tunjangan', 'like', "%{$search}%");
        })
            ->orderBy('id_jabatan', 'asc')
            ->paginate(10);

        return view('jabatan.index', compact('jabatans', 'search'));
    }
    public function create()
    {
        return view('jabatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|integer|min:0',
            'tunjangan' => 'required|integer|min:0',
        ]);

        Jabatan::create($validated);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('jabatan.show', compact('jabatan'));
    }

    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        $validated = $request->validate([
            'jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|integer|min:0',
            'tunjangan' => 'required|integer|min:0',
        ]);

        $jabatan->update($validated);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus!');
    }
}
