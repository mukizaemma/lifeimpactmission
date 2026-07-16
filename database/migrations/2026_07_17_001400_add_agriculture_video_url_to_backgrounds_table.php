<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('backgrounds', function (Blueprint $table) {
            if (! Schema::hasColumn('backgrounds', 'agriculture_video_url')) {
                $table->string('agriculture_video_url')->nullable()->after('image3');
            }
        });
    }

    public function down(): void
    {
        Schema::table('backgrounds', function (Blueprint $table) {
            if (Schema::hasColumn('backgrounds', 'agriculture_video_url')) {
                $table->dropColumn('agriculture_video_url');
            }
        });
    }
};
