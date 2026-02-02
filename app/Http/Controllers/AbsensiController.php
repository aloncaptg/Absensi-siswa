<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AbsensiController extends Controller
{
    public function index(Request $request) {
        $query = Absensi::with('siswa.kelas')->latest('tanggal');
        $kelasOptions = ['X RPL','XI RPL','XII RPL','X BC','XI BC','XII BC','X MM','XI MM','XII MM'];

        if ($request->filled('kelas')) {
            $kelasLabel = $request->get('kelas');
            $query->whereHas('siswa.kelas', function($q) use ($kelasLabel) {
                $q->where('nama_kelas', $kelasLabel);
            });
        }

        if ($request->filled('q')) {
            $term = $request->get('q');
            $query->whereHas('siswa', function($q) use ($term) {
                $q->where('nama', 'like', "%$term%");
            });
        }

        $data = $query->paginate(15)->appends($request->only(['kelas','q']));
        return view('absensi.index', compact('data','kelasOptions'));
    }

    public function create(Request $request) {
        $kelasOptions = ['X RPL','XI RPL','XII RPL','X BC','XI BC','XII BC','X MM','XI MM','XII MM'];
        return view('absensi.form', compact('kelasOptions'));
    }

    public function store(Request $request) {
        $kelasOptions = ['X RPL','XI RPL','XII RPL','X BC','XI BC','XII BC','X MM','XI MM','XII MM'];
        $validated = $request->validate([
            'nama'       => 'required|string|max:100',
            'kelas'      => 'required|in:'.implode(',', $kelasOptions),
            'tanggal'    => 'required|date',
            'status'     => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
        ]);

        // Ensure Kelas exists
        $kelas = Kelas::firstOrCreate(['nama_kelas' => $validated['kelas']], ['wali_kelas' => '-']);
        // Ensure Siswa exists with linked User
        $siswa = Siswa::where('nama', $validated['nama'])->where('kelas_id', $kelas->id)->first();
        if (! $siswa) {
            $email = Str::slug($validated['nama']).'.'.Str::random(6).'@example.com';
            $user = User::create([
                'name' => $validated['nama'],
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ]);
            $siswa = Siswa::create([
                'nama' => $validated['nama'],
                'kelas_id' => $kelas->id,
                'nis' => (string) now()->format('YmdHis'),
                'user_id' => $user->id,
            ]);
        } elseif (! $siswa->user_id) {
            $email = Str::slug($validated['nama']).'.'.Str::random(6).'@example.com';
            $user = User::create([
                'name' => $validated['nama'],
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ]);
            $siswa->update(['user_id' => $user->id]);
        }

        Absensi::create([
            'siswa_id'   => $siswa->id,
            'tanggal'    => $validated['tanggal'],
            'status'     => $validated['status'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);
        return redirect()->route('absensi.index')->with('success','Absensi disimpan');
    }

    public function edit(Request $request, Absensi $absensi) {
        if (! auth()->user()->isAdmin()) {
            abort(403);
        }
        $kelasOptions = ['X RPL','XI RPL','XII RPL','X BC','XI BC','XII BC','X MM','XI MM','XII MM'];
        return view('absensi.form', compact('absensi','kelasOptions'));
    }

    public function update(Request $request, Absensi $absensi) {
        if (! auth()->user()->isAdmin()) {
            abort(403);
        }
        $kelasOptions = ['X RPL','XI RPL','XII RPL','X BC','XI BC','XII BC','X MM','XI MM','XII MM'];
        $validated = $request->validate([
            'nama'       => 'required|string|max:100',
            'kelas'      => 'required|in:'.implode(',', $kelasOptions),
            'tanggal'    => 'required|date',
            'status'     => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
        ]);

        $kelas = Kelas::firstOrCreate(['nama_kelas' => $validated['kelas']], ['wali_kelas' => '-']);
        $siswa = Siswa::where('nama', $validated['nama'])->where('kelas_id', $kelas->id)->first();
        if (! $siswa) {
            $email = Str::slug($validated['nama']).'.'.Str::random(6).'@example.com';
            $user = User::create([
                'name' => $validated['nama'],
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ]);
            $siswa = Siswa::create([
                'nama' => $validated['nama'],
                'kelas_id' => $kelas->id,
                'nis' => (string) now()->format('YmdHis'),
                'user_id' => $user->id,
            ]);
        } elseif (! $siswa->user_id) {
            $email = Str::slug($validated['nama']).'.'.Str::random(6).'@example.com';
            $user = User::create([
                'name' => $validated['nama'],
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ]);
            $siswa->update(['user_id' => $user->id]);
        }

        $absensi->update([
            'siswa_id'   => $siswa->id,
            'tanggal'    => $validated['tanggal'],
            'status'     => $validated['status'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);
        return redirect()->route('absensi.index')->with('success','Absensi diperbarui');
    }

    public function destroy(Absensi $absensi) {
        if (! auth()->user()->isAdmin()) {
            abort(403);
        }
        $absensi->delete();
        return back()->with('success','Absensi dihapus');
    }

    

    public function show() { abort(404); }

    public function laporan() {
        $data = Absensi::with('siswa.kelas')->latest('tanggal')->get();
        return view('absensi.index', compact('data'));
    }

    public function laporanPdf() {
        $data = Absensi::with('siswa.kelas')->latest('tanggal')->get();
        $pdf = Pdf::loadView('absensi.pdf', compact('data'));
        return $pdf->download('laporan-absensi.pdf');
    }
}
