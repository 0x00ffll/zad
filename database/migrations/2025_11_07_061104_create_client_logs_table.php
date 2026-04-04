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
        Schema::create('client_logs', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('stream_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('client_status', 255);
            $table->mediumText('query_string');
            $table->string('user_agent', 255);
            $table->string('ip', 255);
            $table->mediumText('extra_data');
            $table->integer('date');

            $table->index('stream_id', 'client_logs_stream_id');
            $table->index('user_id', 'client_logs_user_id');
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
        Schema::dropIfExists('client_logs');
    }
};

