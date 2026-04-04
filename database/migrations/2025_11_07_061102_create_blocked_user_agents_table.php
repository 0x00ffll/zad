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
        Schema::create('blocked_user_agents', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('user_agent', 255);
            $table->integer('exact_match')->default('0');
            $table->integer('attempts_blocked')->default('0');

            $table->index('exact_match', 'blocked_user_agents_exact_match');
            $table->index('user_agent', 'blocked_user_agents_user_agent');
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
        Schema::dropIfExists('blocked_user_agents');
    }
};

