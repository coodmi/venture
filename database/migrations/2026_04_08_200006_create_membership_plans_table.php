<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('membership_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category'); // general, premium, investor, partner, founder, organization
            $table->text('description')->nullable();
            $table->json('benefits')->nullable();
            $table->decimal('fee', 10, 2)->default(0);
            $table->string('currency', 10)->default('USD');
            $table->integer('duration_months')->default(12);
            $table->text('eligibility')->nullable();
            $table->boolean('is_public')->default(true);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('membership_plan_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['submitted', 'under_review', 'approved', 'rejected', 'revision_required', 'expired'])->default('submitted');
            $table->json('application_data')->nullable();
            $table->json('documents')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memberships');
        Schema::dropIfExists('membership_plans');
    }
};
