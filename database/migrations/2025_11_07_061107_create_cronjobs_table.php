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
        Schema::create('cronjobs', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->mediumText('description');
            $table->string('filename', 255);
            $table->integer('run_per_mins')->default('1');
            $table->integer('run_per_hours')->default('0');
            $table->integer('enabled')->default('0');
            $table->integer('pid')->default('0');
            $table->integer('timestamp')->nullable();

            $table->index('enabled', 'cronjobs_enabled');
            $table->index('filename', 'cronjobs_filename');
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
        Schema::dropIfExists('cronjobs');
    }
};

