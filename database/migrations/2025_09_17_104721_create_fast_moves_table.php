<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fast_moves', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('type'); // Normal, Fighting, Flying, etc.
            $table->integer('power');
            $table->integer('energy'); // Energia gerada
            $table->decimal('duration', 4, 2); // Duração em segundos
            $table->decimal('dps', 6, 2)->nullable(); // Damage per second
            $table->decimal('eps', 6, 2)->nullable(); // Energy per second
            $table->boolean('is_legacy')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['type']);
            $table->index(['is_legacy']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fast_moves');
    }
};
