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
        Schema::create('charge_moves', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('type'); // Normal, Fighting, Flying, etc.
            $table->integer('power');
            $table->integer('energy_cost'); // Energia necessária
            $table->integer('bars'); // 1, 2 ou 3 barras
            $table->decimal('dpe', 6, 2)->nullable(); // Damage per energy
            $table->boolean('has_debuff')->default(false); // Se tem efeito de debuff
            $table->decimal('debuff_chance', 5, 2)->nullable(); // Chance do debuff (0.00 a 1.00)
            $table->string('debuff_type')->nullable(); // attack, defense, etc.
            $table->integer('debuff_stages')->nullable(); // -1, -2, etc.
            $table->boolean('is_legacy')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['type']);
            $table->index(['bars']);
            $table->index(['is_legacy']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charge_moves');
    }
};
