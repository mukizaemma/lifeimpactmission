<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('settings', 'instagram_post_url')) {
            return;
        }

        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE `settings` MODIFY `instagram_post_url` TEXT NULL');
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE settings ALTER COLUMN instagram_post_url TYPE TEXT');
        } elseif ($driver === 'sqlite') {
            // SQLite does not enforce VARCHAR length; no-op is fine.
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('settings', 'instagram_post_url')) {
            return;
        }

        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE `settings` MODIFY `instagram_post_url` VARCHAR(255) NULL');
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE settings ALTER COLUMN instagram_post_url TYPE VARCHAR(255)');
        }
    }
};
