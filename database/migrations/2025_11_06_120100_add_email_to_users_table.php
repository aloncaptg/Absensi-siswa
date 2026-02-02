<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::table('users', function (Blueprint $table) {
			if (! Schema::hasColumn('users', 'email')) {
				$table->string('email', 100);
				$table->index('email');
			}

			if (! Schema::hasColumn('users', 'password')) {
				$table->string('password', 255)->nullable();
			}

			if (! Schema::hasColumn('users', 'remember_token')) {
				$table->string('remember_token', 100)->nullable();
			}
		});
	}

	public function down(): void
	{
		Schema::table('users', function (Blueprint $table) {
			if (Schema::hasColumn('users', 'email')) {
				$table->dropIndex(['email']);
				$table->dropColumn('email');
			}
			if (Schema::hasColumn('users', 'password')) {
				$table->dropColumn('password');
			}
			if (Schema::hasColumn('users', 'remember_token')) {
				$table->dropColumn('remember_token');
			}
		});
	}
};


