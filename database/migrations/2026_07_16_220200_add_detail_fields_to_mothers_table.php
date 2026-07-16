<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mothers', function (Blueprint $table) {
            $table->string('location')->nullable()->after('title');
            $table->string('program')->nullable()->after('location');
            $table->string('video_url')->nullable()->after('story');
            $table->string('quote')->nullable()->after('video_url');
        });
    }

    public function down(): void
    {
        Schema::table('mothers', function (Blueprint $table) {
            $table->dropColumn(['location', 'program', 'video_url', 'quote']);
        });
    }
};
