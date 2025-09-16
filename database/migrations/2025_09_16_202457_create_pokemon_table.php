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
        Schema::create('pokemon', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Dados básicos da PokéAPI
            $table->string('name');
            $table->integer('pokedex_number');
            $table->json('types');
            $table->string('sprite_url')->nullable();
            $table->integer('base_hp')->nullable();
            $table->integer('base_attack')->nullable();
            $table->integer('base_defense')->nullable();
            $table->integer('base_special_attack')->nullable();
            $table->integer('base_special_defense')->nullable();
            $table->integer('base_speed')->nullable();
            $table->string('generation')->nullable();
            $table->string('region')->nullable();

            // Dados específicos do Pokémon GO
            $table->integer('cp')->nullable();
            $table->integer('hp')->nullable();
            $table->integer('iv_attack')->nullable();
            $table->integer('iv_defense')->nullable();
            $table->integer('iv_hp')->nullable();
            $table->decimal('iv_percentage', 5, 2)->nullable();
            $table->boolean('is_perfect_iv')->default(false);
            $table->boolean('is_shiny')->default(false);
            $table->boolean('is_lucky')->default(false);
            $table->boolean('is_shadow')->default(false);
            $table->boolean('is_purified')->default(false);
            $table->string('fast_move')->nullable();
            $table->string('charge_move_1')->nullable();
            $table->string('charge_move_2')->nullable();
            $table->date('caught_at')->nullable();
            $table->string('location_caught')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            // Índices otimizados para MariaDB
            $table->index(['user_id', 'name']);
            $table->index(['user_id', 'pokedex_number']); // Muito útil para buscas
            $table->index(['user_id', 'is_perfect_iv']);
            $table->index(['user_id', 'is_shiny']);
            $table->index(['user_id', 'region']);
            $table->index(['user_id', 'caught_at']); // Para ordenar por data de captura
            $table->index('pokedex_number'); // Busca global por número
            $table->index(['is_perfect_iv', 'is_shiny']); // Combinações especiais

            // Para consultas de types, use WHERE JSON_CONTAINS() nas queries
            // Não indexamos JSON diretamente devido às limitações do MariaDB
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon');
    }
};
