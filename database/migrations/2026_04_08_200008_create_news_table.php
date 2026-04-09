<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('news'); // news, notice, press_release, newsletter
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->nullable();
            $table->text('summary')->nullable();
            $table->longText('body')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('author')->nullable();
            $table->json('tags')->nullable();
            $table->string('attachment')->nullable();
            $table->string('importance_level')->nullable(); // for notices: low, medium, high, urgent
            $table->timestamp('deadline')->nullable();
            $table->string('audience_scope')->nullable(); // public, members, investors, seekers
            $table->enum('status', ['draft', 'published', 'archived', 'scheduled'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
