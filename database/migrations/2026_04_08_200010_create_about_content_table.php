<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about_content', function (Blueprint $table) {
            $table->id();
            $table->string('section'); // overview, vision, mission, values, founder_message, timeline
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('video_url')->nullable();
            $table->json('extra')->nullable(); // for flexible data like timeline items, values list
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_content');
    }
};
