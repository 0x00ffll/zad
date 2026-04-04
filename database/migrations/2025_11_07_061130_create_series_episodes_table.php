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
        Schema::create('series_episodes', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('season_num');
            $table->integer('series_id');
            $table->integer('stream_id');
            $table->integer('sort');

            $table->index('season_num', 'series_episodes_season_num');
            $table->index('series_id', 'series_episodes_series_id');
            $table->index('stream_id', 'series_episodes_stream_id');
            $table->index('sort', 'series_episodes_sort');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series_episodes');
    }
};

