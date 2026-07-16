<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('backgrounds', function (Blueprint $table) {
            if (! Schema::hasColumn('backgrounds', 'image3')) {
                $table->string('image3')->nullable()->after('image2');
            }
        });
    }

    public function down(): void
    {
        Schema::table('backgrounds', function (Blueprint $table) {
            if (Schema::hasColumn('backgrounds', 'image3')) {
                $table->dropColumn('image3');
            }
        });
    }
};
