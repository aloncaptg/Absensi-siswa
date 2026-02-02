<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index() {
        $data = Kelas::latest()->paginate(10);
        return view('kelas.index', compact('data'));
    }

    public function create() { return view('kelas.form'); }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'wali_kelas' => 'required|string|max:100',
        ]);
        Kelas::create($validated);
        return redirect()->route('kelas.index')->with('success','Kelas ditambahkan');
    }

    public function edit(Kelas $kela) {
        return view('kelas.form', ['kelas' => $kela]);
    }

    public function update(Request $request, Kelas $kela) {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'wali_kelas' => 'required|string|max:100',
        ]);
        $kela->update($validated);
        return redirect()->route('kelas.index')->with('success','Kelas diperbarui');
    }

    public function destroy(Kelas $kela) {
        $kela->delete();
        return back()->with('success','Kelas dihapus');
    }

    public function show() { abort(404); }
}
