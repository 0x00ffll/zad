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
        Schema::create('credits_log', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('target_id');
            $table->integer('admin_id');
            $table->float('amount');
            $table->integer('date');
            $table->text('reason');

            $table->index('target_id', 'credits_log_target_id');
            $table->index('admin_id', 'credits_log_admin_id');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits_log');
    }
};

