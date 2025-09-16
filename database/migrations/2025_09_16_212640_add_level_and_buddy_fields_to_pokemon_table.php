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
            $table->decimal('level', 4, 1)->nullable()->after('iv_percentage'); // Level 1.0 até 50.0
            $table->boolean('is_buddy')->default(false)->after('is_purified'); // Se é companheiro atual
            $table->enum('buddy_level', ['good', 'great', 'ultra', 'best'])->nullable()->after('is_buddy'); // Nível máximo alcançado de companheiro
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pokemon', function (Blueprint $table) {
            $table->dropColumn(['level', 'is_buddy', 'buddy_level']);
        });
    }
};
