<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		if (Schema::hasTable('guru') && Schema::hasColumn('guru', 'nama_lengkap')) {
			DB::statement('ALTER TABLE `guru` MODIFY `nama_lengkap` varchar(191) NULL');
		}
	}

	public function down(): void
	{
		if (Schema::hasTable('guru') && Schema::hasColumn('guru', 'nama_lengkap')) {
			DB::statement('ALTER TABLE `guru` MODIFY `nama_lengkap` varchar(191) NOT NULL');
		}
	}
};



