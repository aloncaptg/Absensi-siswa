<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		if (Schema::hasTable('siswa') && Schema::hasColumn('siswa', 'nama_lengkap')) {
			DB::statement('ALTER TABLE `siswa` MODIFY `nama_lengkap` varchar(191) NULL');
		}
	}

	public function down(): void
	{
		if (Schema::hasTable('siswa') && Schema::hasColumn('siswa', 'nama_lengkap')) {
			DB::statement('ALTER TABLE `siswa` MODIFY `nama_lengkap` varchar(191) NOT NULL');
		}
	}
};

