<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seeker_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('company_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('industry')->nullable();
            $table->string('stage')->nullable(); // idea, mvp, early, growth, scale
            $table->integer('team_size')->nullable();
            $table->string('location')->nullable();
            $table->string('country')->nullable();
            $table->string('website')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->text('business_summary')->nullable();
            $table->string('photo')->nullable();
            $table->integer('profile_completion')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seeker_profiles');
    }
};
