<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('investor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('investor_type')->nullable(); // angel, vc, corporate, family_office
            $table->string('organization')->nullable();
            $table->string('designation')->nullable();
            $table->json('sector_preferences')->nullable();
            $table->json('geographic_interest')->nullable();
            $table->string('ticket_size_min')->nullable();
            $table->string('ticket_size_max')->nullable();
            $table->string('investment_stage')->nullable(); // seed, series_a, series_b, growth
            $table->string('risk_profile')->nullable(); // conservative, moderate, aggressive
            $table->string('linkedin_url')->nullable();
            $table->string('website')->nullable();
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->integer('profile_completion')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investor_profiles');
    }
};
