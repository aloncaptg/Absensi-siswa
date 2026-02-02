<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::table('users', function (Blueprint $table) {
			if (! Schema::hasColumn('users', 'name')) {
				$table->string('name', 100)->nullable();
			}
			if (! Schema::hasColumn('users', 'role')) {
				$table->enum('role', ['admin', 'guru', 'siswa'])->default('siswa');
			}
			if (! Schema::hasColumn('users', 'created_at')) {
				$table->timestamp('created_at')->nullable();
			}
			if (! Schema::hasColumn('users', 'updated_at')) {
				$table->timestamp('updated_at')->nullable();
			}
		});
	}

	public function down(): void
	{
		Schema::table('users', function (Blueprint $table) {
			if (Schema::hasColumn('users', 'name')) {
				$table->dropColumn('name');
			}
			if (Schema::hasColumn('users', 'role')) {
				$table->dropColumn('role');
			}
			if (Schema::hasColumn('users', 'created_at')) {
				$table->dropColumn('created_at');
			}
			if (Schema::hasColumn('users', 'updated_at')) {
				$table->dropColumn('updated_at');
			}
		});
	}
};



