<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('guru_absensi')) {
            Schema::create('guru_absensi', function (Blueprint $table) {
                $table->id();
                $table->foreignId('guru_id')->constrained('guru')->cascadeOnDelete();
                $table->date('tanggal');
                $table->enum('status', ['hadir','izin','sakit','alpha']);
                $table->text('keterangan')->nullable();
                $table->timestamps();
            });
        } else {
            // Table exists, just add foreign key if missing
            Schema::table('guru_absensi', function (Blueprint $table) {
                if (!Schema::hasColumn('guru_absensi', 'guru_id')) {
                    $table->foreignId('guru_id')->constrained('guru')->cascadeOnDelete();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru_absensi');
    }
};
