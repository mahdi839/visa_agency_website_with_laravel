<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('hero_label')->default('Who We Are');
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('story_title')->default('Our Story');
            $table->longText('story_body');
            $table->string('mission_title')->default('Our Mission');
            $table->longText('mission_body');
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
