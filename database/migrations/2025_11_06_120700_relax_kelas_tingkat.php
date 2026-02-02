<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		if (Schema::hasTable('kelas') && Schema::hasColumn('kelas', 'tingkat')) {
			DB::statement('ALTER TABLE `kelas` MODIFY `tingkat` varchar(50) NULL');
		}
	}

	public function down(): void
	{
		if (Schema::hasTable('kelas') && Schema::hasColumn('kelas', 'tingkat')) {
			DB::statement('ALTER TABLE `kelas` MODIFY `tingkat` varchar(50) NOT NULL');
		}
	}
};



