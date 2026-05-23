<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('linkedin')->nullable()->after('instagram');
            $table->string('tiktok')->nullable()->after('linkedin');
            $table->string('linktree')->nullable()->after('youtube');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['linkedin', 'tiktok', 'linktree']);
        });
    }
};
