<?php

namespace App\Http\Controllers;

use App\Models\GuruAbsensi;
use App\Models\Guru;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GuruAbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin() && !auth()->user()->isGuru()) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index(Request $request) 
    {
        $query = GuruAbsensi::with('guru')->latest('tanggal');

        if ($request->filled('q')) {
            $term = $request->get('q');
            $query->whereHas('guru', function($q) use ($term) {
                $q->where('nama', 'like', "%$term%");
            });
        }

        $data = $query->paginate(15)->appends($request->only(['q']));
        return view('guru-absensi.index', compact('data'));
    }

    public function create(Request $request) 
    {
        return view('guru-absensi.form');
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:100',
            'tanggal'    => 'required|date',
            'status'     => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
        ]);

        // Find or create Guru
        $guru = Guru::where('nama', $validated['nama'])->first();
        if (!$guru) {
            $guru = Guru::create([
                'nama' => $validated['nama'],
                'nip' => 'G-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
            ]);
        }

        GuruAbsensi::create([
            'guru_id'     => $guru->id,
            'tanggal'     => $validated['tanggal'],
            'status'      => $validated['status'],
            'keterangan'  => $validated['keterangan'] ?? null,
        ]);
        
        return redirect()->route('guru-absensi.index')->with('success','Absensi guru disimpan');
    }

    public function edit(Request $request, GuruAbsensi $guruAbsensi) 
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        return view('guru-absensi.form', compact('guruAbsensi'));
    }

    public function update(Request $request, GuruAbsensi $guruAbsensi) 
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        
        $validated = $request->validate([
            'nama'       => 'required|string|max:100',
            'tanggal'    => 'required|date',
            'status'     => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
        ]);

        // Find or create Guru
        $guru = Guru::where('nama', $validated['nama'])->first();
        if (!$guru) {
            $guru = Guru::create([
                'nama' => $validated['nama'],
                'nip' => 'G-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
            ]);
        }

        $guruAbsensi->update([
            'guru_id'     => $guru->id,
            'tanggal'     => $validated['tanggal'],
            'status'      => $validated['status'],
            'keterangan'  => $validated['keterangan'] ?? null,
        ]);
        
        return redirect()->route('guru-absensi.index')->with('success','Absensi guru diperbarui');
    }

    public function destroy(GuruAbsensi $guruAbsensi) 
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }
        $guruAbsensi->delete();
        return back()->with('success','Absensi guru dihapus');
    }

    public function show() 
    { 
        abort(404); 
    }

    public function laporan() 
    {
        $data = GuruAbsensi::with('guru')->latest('tanggal')->get();
        return view('guru-absensi.index', compact('data'));
    }

    public function laporanPdf() 
    {
        $data = GuruAbsensi::with('guru')->latest('tanggal')->get();
        $pdf = Pdf::loadView('guru-absensi.pdf', compact('data'));
        return $pdf->download('laporan-absensi-guru.pdf');
    }
}
