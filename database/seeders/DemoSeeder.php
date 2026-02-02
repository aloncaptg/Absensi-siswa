<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        $guru1 = User::updateOrCreate(
            ['email' => 'guru1@example.com'],
            ['name' => 'Guru 1', 'password' => Hash::make('password'), 'role' => 'guru']
        );
        $guru2 = User::updateOrCreate(
            ['email' => 'guru2@example.com'],
            ['name' => 'Guru 2', 'password' => Hash::make('password'), 'role' => 'guru']
        );

        Guru::updateOrCreate(['nip' => 'G-001'], ['nama' => 'Guru 1', 'user_id' => $guru1->id]);
        Guru::updateOrCreate(['nip' => 'G-002'], ['nama' => 'Guru 2', 'user_id' => $guru2->id]);

        $k1 = Kelas::updateOrCreate(['nama_kelas' => 'X RPL 1'], ['wali_kelas' => 'Guru 1']);
        $k2 = Kelas::updateOrCreate(['nama_kelas' => 'X RPL 2'], ['wali_kelas' => 'Guru 2']);

        $s1u = User::updateOrCreate(['email' => 'siswa1@example.com'], ['name' => 'Siswa 1', 'password' => Hash::make('password'), 'role' => 'siswa']);
        $s2u = User::updateOrCreate(['email' => 'siswa2@example.com'], ['name' => 'Siswa 2', 'password' => Hash::make('password'), 'role' => 'siswa']);
        $s3u = User::updateOrCreate(['email' => 'siswa3@example.com'], ['name' => 'Siswa 3', 'password' => Hash::make('password'), 'role' => 'siswa']);

        $s1 = Siswa::updateOrCreate(['nis' => '12345'], ['nama' => 'Siswa 1', 'kelas_id' => $k1->id, 'user_id' => $s1u->id]);
        $s2 = Siswa::updateOrCreate(['nis' => '12346'], ['nama' => 'Siswa 2', 'kelas_id' => $k1->id, 'user_id' => $s2u->id]);
        $s3 = Siswa::updateOrCreate(['nis' => '12347'], ['nama' => 'Siswa 3', 'kelas_id' => $k2->id, 'user_id' => $s3u->id]);

        Absensi::updateOrCreate(['siswa_id' => $s1->id, 'tanggal' => now()->toDateString()], ['status' => 'hadir', 'keterangan' => '-']);
        Absensi::updateOrCreate(['siswa_id' => $s2->id, 'tanggal' => now()->toDateString()], ['status' => 'izin', 'keterangan' => 'Sakit perut']);
        Absensi::updateOrCreate(['siswa_id' => $s3->id, 'tanggal' => now()->toDateString()], ['status' => 'alpha', 'keterangan' => 'Tidak hadir']);
    }
}
