<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_section_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->string('title')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->json('content')->nullable();
            $table->json('settings')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_blocks');
    }
};
