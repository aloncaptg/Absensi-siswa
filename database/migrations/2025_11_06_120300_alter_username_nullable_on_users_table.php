<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		if (Schema::hasColumn('users', 'username')) {
			DB::statement('ALTER TABLE `users` MODIFY `username` varchar(255) NULL');
		}
	}

	public function down(): void
	{
		if (Schema::hasColumn('users', 'username')) {
			DB::statement('ALTER TABLE `users` MODIFY `username` varchar(255) NOT NULL');
		}
	}
};



