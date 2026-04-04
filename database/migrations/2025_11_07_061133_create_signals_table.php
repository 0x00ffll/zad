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
        Schema::create('signals', function (Blueprint $table) {
            $table->integer('signal_id')->autoIncrement();
            $table->integer('pid');
            $table->integer('server_id');
            $table->integer('rtmp')->default('0');
            $table->integer('time');

            $table->index('server_id', 'signals_server_id');
            $table->index('time', 'signals_time');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signals');
    }
};

