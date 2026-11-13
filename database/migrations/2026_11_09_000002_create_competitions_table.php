<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('organizer');
            $table->enum('category', ['Kampus', 'Nasional', 'Internasional'])->default('Kampus');
            $table->string('banner')->nullable();
            $table->longText('description')->nullable();
            $table->date('registration_start')->nullable();
            $table->date('registration_end')->nullable();
            $table->date('event_start')->nullable();
            $table->date('event_end')->nullable();
            $table->string('registration_url')->nullable();
            $table->string('location')->nullable();
            $table->string('contact')->nullable();
            $table->text('benefits')->nullable();
            $table->enum('mode', ['Online', 'Offline'])->default('Online');
            $table->enum('status', ['draft', 'published', 'closed'])->default('draft');
            $table->timestamps();
            $table->index(['status', 'category']);
        });
    }
    public function down(): void { Schema::dropIfExists('competitions'); }
};
