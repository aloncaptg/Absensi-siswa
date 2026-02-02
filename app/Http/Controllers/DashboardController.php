<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->isAdmin())   return $this->admin();
        if ($user->isGuru())    return $this->guru();
        if ($user->isSiswa())   return $this->siswa();
        abort(404);
    }

    public function admin()
    {
        $totalSiswa  = Siswa::count();
        $totalKelas  = Kelas::count();
        $today       = now()->toDateString();
        $hadir       = Absensi::where('tanggal',$today)->where('status','hadir')->count();
        $alpha       = Absensi::where('tanggal',$today)->where('status','alpha')->count();
        $izin        = Absensi::where('tanggal',$today)->where('status','izin')->count();
        $sakit       = Absensi::where('tanggal',$today)->where('status','sakit')->count();

        return view('dashboard.admin', compact('totalSiswa','totalKelas','hadir','alpha','izin','sakit'));
    }

    public function guru()
    {
        $today = now()->toDateString();
        $rekap = Absensi::with('siswa.kelas')->where('tanggal',$today)->get();
        return view('dashboard.guru', compact('rekap'));
    }

    public function siswa()
    {
        $siswaId = optional(auth()->user()->siswa)->id;
        $riwayat = Absensi::where('siswa_id',$siswaId)->latest('tanggal')->limit(30)->get();
        return view('dashboard.siswa', compact('riwayat'));
    }
}
