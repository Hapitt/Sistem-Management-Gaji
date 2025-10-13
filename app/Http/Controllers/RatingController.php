<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // ambil input pencarian

        $ratings = Rating::when($search, function ($query, $search) {
            // 🔹 Jika user ketik "15%", ubah jadi "0.15"
            if (str_contains($search, '%')) {
                $numeric = floatval(str_replace('%', '', $search)) / 100;
                $searchDecimal = (string) $numeric;
            } else {
                $searchDecimal = $search;
            }

            $query->where('rating', 'like', "%{$search}%")
                ->orWhere('presentase_bonus', 'like', "%{$searchDecimal}%");
        })
            ->orderBy('id_rating', 'asc')
            ->get();

        return view('rating.index', compact('ratings', 'search'));
    }


    public function create()
    {
        return view('rating.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|numeric',
            'presentase_bonus' => 'required|numeric|min:0|max:1', // batas maksimal 100%
        ]);

        // Hitung total presentase bonus saat ini
        $totalPresentase = Rating::sum('presentase_bonus') + $validated['presentase_bonus'];

        if ($totalPresentase > 1) { // 1 = 100%
            return back()
                ->withInput()
                ->withErrors(['presentase_bonus' => 'Total presentase bonus tidak boleh melebihi 100%!']);
        }

        Rating::create($validated);

        return redirect()->route('rating.index')->with('success', 'Rating berhasil ditambahkan!');
    }

    public function show($id)
    {
        $rating = Rating::findOrFail($id);
        return view('rating.show', compact('rating'));
    }

    public function edit($id)
    {
        $rating = Rating::findOrFail($id);
        return view('rating.edit', compact('rating'));
    }

    public function update(Request $request, $id)
    {
        $rating = Rating::findOrFail($id);

        $validated = $request->validate([
            'rating' => 'required|numeric',
            'presentase_bonus' => 'required|numeric|min:0|max:1',
        ]);

        // Hitung total presentase bonus saat ini, kecuali rating ini
        $totalPresentase = Rating::where('id_rating', '!=', $id)->sum('presentase_bonus') + $validated['presentase_bonus'];

        if ($totalPresentase > 1) {
            return back()
                ->withInput()
                ->withErrors(['presentase_bonus' => 'Total presentase bonus tidak boleh melebihi 100%!']);
        }

        $rating->update($validated);

        return redirect()->route('rating.index')->with('success', 'Rating berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();

        return redirect()->route('rating.index')->with('success', 'Rating berhasil dihapus!');
    }
}
