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
        Schema::create('enigma2_failed', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('original_mac', 255);
            $table->string('virtual_mac', 255);
            $table->integer('date');

            $table->index('original_mac', 'enigma2_failed_original_mac');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enigma2_failed');
    }
};

