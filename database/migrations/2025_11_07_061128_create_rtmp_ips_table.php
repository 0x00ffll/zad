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
        Schema::create('rtmp_ips', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('ip', 255);
            $table->text('notes');            $table->unique('ip', 'rtmp_ips_ip');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rtmp_ips');
    }
};

