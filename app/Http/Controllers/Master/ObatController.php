<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::latest()->paginate(20);
        return view('master.obat.index', compact('obat'));
    }

    public function create()
    {
        return view('master.obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
        ]);

        Obat::create($request->all());

        return redirect()->route('master.obat.index')
            ->with('success', 'Obat berhasil ditambahkan');
    }

    public function edit(Obat $obat)
    {
        return view('master.obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
        ]);

        $obat->update($request->all());

        return redirect()->route('master.obat.index')
            ->with('success', 'Obat berhasil diupdate');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('master.obat.index')
            ->with('success', 'Obat berhasil dihapus');
    }
}
