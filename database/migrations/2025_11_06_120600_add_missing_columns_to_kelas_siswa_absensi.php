<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		if (Schema::hasTable('kelas')) {
			Schema::table('kelas', function (Blueprint $table) {
				if (! Schema::hasColumn('kelas', 'nama_kelas')) {
					$table->string('nama_kelas', 50)->nullable();
				}
				if (! Schema::hasColumn('kelas', 'wali_kelas')) {
					$table->string('wali_kelas', 100)->nullable();
				}
				if (! Schema::hasColumn('kelas', 'created_at')) {
					$table->timestamp('created_at')->nullable();
				}
				if (! Schema::hasColumn('kelas', 'updated_at')) {
					$table->timestamp('updated_at')->nullable();
				}
			});
		}

		if (Schema::hasTable('siswa')) {
			Schema::table('siswa', function (Blueprint $table) {
				if (! Schema::hasColumn('siswa', 'nama')) {
					$table->string('nama', 100)->nullable();
				}
				if (! Schema::hasColumn('siswa', 'nis')) {
					$table->string('nis', 50)->nullable();
				}
				if (! Schema::hasColumn('siswa', 'kelas_id')) {
					$table->foreignId('kelas_id')->nullable()->constrained('kelas')->cascadeOnDelete();
				}
				if (! Schema::hasColumn('siswa', 'user_id')) {
					$table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
				}
				if (! Schema::hasColumn('siswa', 'created_at')) {
					$table->timestamp('created_at')->nullable();
				}
				if (! Schema::hasColumn('siswa', 'updated_at')) {
					$table->timestamp('updated_at')->nullable();
				}
			});
		}

		if (Schema::hasTable('absensi')) {
			Schema::table('absensi', function (Blueprint $table) {
				if (! Schema::hasColumn('absensi', 'siswa_id')) {
					$table->foreignId('siswa_id')->nullable()->constrained('siswa')->cascadeOnDelete();
				}
				if (! Schema::hasColumn('absensi', 'tanggal')) {
					$table->date('tanggal')->nullable();
				}
				if (! Schema::hasColumn('absensi', 'status')) {
					$table->enum('status', ['hadir','izin','sakit','alpha'])->nullable();
				}
				if (! Schema::hasColumn('absensi', 'keterangan')) {
					$table->text('keterangan')->nullable();
				}
				if (! Schema::hasColumn('absensi', 'created_at')) {
					$table->timestamp('created_at')->nullable();
				}
				if (! Schema::hasColumn('absensi', 'updated_at')) {
					$table->timestamp('updated_at')->nullable();
				}
			});
		}
	}

	public function down(): void
	{
		// Intentionally left non-destructive.
	}
};



