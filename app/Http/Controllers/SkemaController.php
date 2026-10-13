<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    public function index() {
        $skema = Skema::latest()->get();
        return view('skema.index', compact('skema'));
    }

    public function store(Request $request) {
        $request->validate([
            'kode_skema' => 'required|unique:skema,kode_skema',
            'nama_skema' => 'required',
        ]);

        Skema::create($request->all());
        return redirect()->route('skema.index')->with('success', 'Data skema berhasil ditambahkan!');
    }

    public function edit($id) {
        $skema = Skema::findOrFail($id);
        return view('skema.edit', compact('skema'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'kode_skema' => 'required',
            'nama_skema' => 'required',
        ]);

        $skema = Skema::findOrFail($id);
        $skema->update($request->all());

        return redirect()->route('skema.index')->with('success', 'Skema berhasil diperbarui!');
    }

    public function destroy($id) {
        $skema = Skema::findOrFail($id);
        $skema->delete();
        return redirect()->route('skema.index')->with('success', 'Data skema berhasil dihapus!');
    }
}