<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('theme_setting_id')->nullable()->constrained('theme_settings')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('status')->default('draft');
            $table->string('layout_variant')->nullable();
            $table->text('description')->nullable();
            $table->json('meta')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_templates');
    }
};
