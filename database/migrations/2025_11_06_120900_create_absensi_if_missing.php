<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		if (! Schema::hasTable('absensi')) {
			Schema::create('absensi', function (Blueprint $table) {
				$table->id();
				$table->unsignedBigInteger('siswa_id')->nullable();
				$table->date('tanggal')->nullable();
				$table->enum('status', ['hadir','izin','sakit','alpha'])->nullable();
				$table->text('keterangan')->nullable();
				$table->timestamps();
			});
		}
	}

	public function down(): void
	{
		Schema::dropIfExists('absensi');
	}
};

