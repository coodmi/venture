<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->nullable();
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('banner')->nullable();
            $table->string('event_type')->default('offline'); // online, offline, hybrid
            $table->string('venue')->nullable();
            $table->string('online_link')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->json('speakers')->nullable();
            $table->longText('agenda')->nullable();
            $table->boolean('registration_open')->default(true);
            $table->integer('max_attendees')->nullable();
            $table->enum('status', ['draft', 'published', 'cancelled', 'completed', 'archived'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('organization')->nullable();
            $table->string('designation')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
        Schema::dropIfExists('events');
    }
};
