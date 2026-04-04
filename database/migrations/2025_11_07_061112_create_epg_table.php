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
        Schema::create('epg', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('epg_name', 255);
            $table->string('epg_file', 300);
            $table->string('integrity', 255)->nullable();
            $table->integer('last_updated')->nullable();
            $table->integer('days_keep')->default('7');
            $table->longText('data');            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epg');
    }
};

