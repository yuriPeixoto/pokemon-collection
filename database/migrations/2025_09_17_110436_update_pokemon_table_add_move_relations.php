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
        Schema::table('pokemon', function (Blueprint $table) {
            // Adicionar novas colunas FK
            $table->foreignId('fast_move_id')->nullable()->constrained('fast_moves')->onDelete('set null');
            $table->foreignId('charge_move_1_id')->nullable()->constrained('charge_moves')->onDelete('set null');
            $table->foreignId('charge_move_2_id')->nullable()->constrained('charge_moves')->onDelete('set null');

            // Manter as colunas antigas por enquanto para migração de dados
            // $table->string('fast_move')->nullable()->change();
            // $table->string('charge_move_1')->nullable()->change();
            // $table->string('charge_move_2')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pokemon', function (Blueprint $table) {
            $table->dropForeign(['fast_move_id']);
            $table->dropForeign(['charge_move_1_id']);
            $table->dropForeign(['charge_move_2_id']);

            $table->dropColumn('fast_move_id');
            $table->dropColumn('charge_move_1_id');
            $table->dropColumn('charge_move_2_id');
        });
    }
};
