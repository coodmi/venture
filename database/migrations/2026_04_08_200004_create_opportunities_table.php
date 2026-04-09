<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('seeker_profile_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('sector')->nullable();
            $table->string('stage')->nullable();
            $table->string('location')->nullable();
            $table->string('country')->nullable();
            $table->text('business_problem')->nullable();
            $table->text('solution')->nullable();
            $table->text('target_market')->nullable();
            $table->text('traction')->nullable();
            $table->decimal('ask_amount', 15, 2)->nullable();
            $table->string('ask_currency', 10)->default('USD');
            $table->text('use_of_funds')->nullable();
            $table->text('key_metrics')->nullable();
            $table->string('pitch_deck')->nullable();
            $table->json('documents')->nullable();
            $table->enum('status', ['draft', 'submitted', 'under_review', 'approved', 'rejected', 'archived'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_hot_deal')->default(false);
            $table->timestamp('featured_until')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
