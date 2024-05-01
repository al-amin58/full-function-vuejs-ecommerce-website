<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->longText('summery')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('is_delete')->default(false);
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->longText('seo_key_words')->nullable();
            $table->string('seo_icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
