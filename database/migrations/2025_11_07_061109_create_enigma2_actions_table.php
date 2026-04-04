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
        Schema::create('enigma2_actions', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('device_id');
            $table->text('type');
            $table->text('key');
            $table->text('command');
            $table->text('command2');            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enigma2_actions');
    }
};

