<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->enum('status', ['draft', 'published', 'selesai'])->default('draft')->after('image');
            $table->text('terms')->nullable()->after('status');
            $table->string('organizer_name')->nullable()->after('terms');
            $table->string('organizer_social')->nullable()->after('organizer_name');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['status', 'terms', 'organizer_name', 'organizer_social']);
        });
    }
};
