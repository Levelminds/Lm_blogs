<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->timestamp('published_at')->nullable()->after('content');
            $table->boolean('is_featured')->default(false)->after('published_at');
            $table->string('reading_time')->nullable()->after('is_featured');
            $table->json('metadata')->nullable()->after('reading_time');
        });

        DB::table('blogs')->whereNull('published_at')->update([
            'published_at' => DB::raw('created_at'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['published_at', 'is_featured', 'reading_time', 'metadata']);
        });
    }
};
