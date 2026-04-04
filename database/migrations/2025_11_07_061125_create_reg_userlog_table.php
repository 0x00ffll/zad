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
        Schema::create('reg_userlog', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('owner');
            $table->mediumText('username');
            $table->mediumText('password');
            $table->integer('date');
            $table->string('type', 255);            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reg_userlog');
    }
};

