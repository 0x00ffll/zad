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
        Schema::create('access_output', function (Blueprint $table) {
            $table->integer('access_output_id')->autoIncrement();
            $table->string('output_name', 255);
            $table->string('output_key', 255);
            $table->string('output_ext', 255);

            $table->index('output_key', 'access_output_output_key');
            $table->index('output_ext', 'access_output_output_ext');
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
        Schema::dropIfExists('access_output');
    }
};

