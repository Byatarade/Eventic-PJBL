<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('organizer_ig')->nullable()->after('organizer_social');
            $table->string('organizer_tiktok')->nullable()->after('organizer_ig');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['organizer_ig', 'organizer_tiktok']);
        });
    }
};
