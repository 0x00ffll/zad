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
        Schema::create('reseller_imex', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('reg_id');
            $table->longText('header');
            $table->longText('data');
            $table->integer('accepted')->default('0');
            $table->integer('finished')->default('0');
            $table->text('bouquet_ids');

            $table->index('reg_id', 'reseller_imex_reg_id');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseller_imex');
    }
};

