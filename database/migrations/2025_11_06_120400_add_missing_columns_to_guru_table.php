<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		if (Schema::hasTable('guru')) {
			Schema::table('guru', function (Blueprint $table) {
				if (! Schema::hasColumn('guru', 'nama')) {
					$table->string('nama', 100)->nullable();
				}
				if (! Schema::hasColumn('guru', 'nip')) {
					$table->string('nip', 50)->nullable();
				}
				if (! Schema::hasColumn('guru', 'user_id')) {
					$table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
				}
				if (! Schema::hasColumn('guru', 'created_at')) {
					$table->timestamp('created_at')->nullable();
				}
				if (! Schema::hasColumn('guru', 'updated_at')) {
					$table->timestamp('updated_at')->nullable();
				}
			});
		}
	}

	public function down(): void
	{
		if (Schema::hasTable('guru')) {
			Schema::table('guru', function (Blueprint $table) {
				if (Schema::hasColumn('guru', 'nama')) { $table->dropColumn('nama'); }
				if (Schema::hasColumn('guru', 'nip')) { $table->dropColumn('nip'); }
				if (Schema::hasColumn('guru', 'user_id')) { $table->dropConstrainedForeignId('user_id'); }
				if (Schema::hasColumn('guru', 'created_at')) { $table->dropColumn('created_at'); }
				if (Schema::hasColumn('guru', 'updated_at')) { $table->dropColumn('updated_at'); }
			});
		}
	}
};



