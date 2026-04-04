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
        Schema::create('series', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('title', 255);
            $table->integer('category_id')->nullable();
            $table->string('cover', 255);
            $table->string('cover_big', 255);
            $table->string('genre', 255);
            $table->text('plot');
            $table->text('cast');
            $table->integer('rating');
            $table->string('director', 255);
            $table->string('releaseDate', 255);
            $table->integer('last_modified');
            $table->integer('tmdb_id');
            $table->mediumText('seasons');
            $table->integer('episode_run_time')->default('0');
            $table->text('backdrop_path');
            $table->text('youtube_trailer');

            $table->index('last_modified', 'series_last_modified');
            $table->index('tmdb_id', 'series_tmdb_id');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};

