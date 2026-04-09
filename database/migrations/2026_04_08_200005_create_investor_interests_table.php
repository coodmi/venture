<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('investor_interests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investor_profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('opportunity_id')->constrained()->cascadeOnDelete();
            $table->enum('action', ['viewed', 'saved', 'interested', 'meeting_requested', 'shortlisted'])->default('viewed');
            $table->text('notes')->nullable();
            $table->enum('pipeline_stage', ['discovered', 'shortlisted', 'reviewing', 'meeting', 'negotiating', 'invested', 'closed'])->nullable();
            $table->timestamps();
            $table->unique(['investor_profile_id', 'opportunity_id', 'action'], 'investor_interest_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investor_interests');
    }
};
