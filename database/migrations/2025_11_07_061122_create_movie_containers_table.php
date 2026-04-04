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
        Schema::create('movie_containers', function (Blueprint $table) {
            $table->integer('container_id')->autoIncrement();
            $table->string('container_extension', 255);
            $table->string('container_header', 255);

            $table->index('container_extension', 'movie_containers_container_extension');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_containers');
    }
};

