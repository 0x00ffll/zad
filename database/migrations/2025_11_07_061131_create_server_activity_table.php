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
        Schema::create('server_activity', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('source_server_id');
            $table->integer('dest_server_id');
            $table->integer('stream_id');
            $table->integer('pid')->nullable();
            $table->integer('bandwidth')->default('0');
            $table->integer('date_start');
            $table->integer('date_end')->nullable();

            $table->index('source_server_id', 'server_activity_source_server_id');
            $table->index('dest_server_id', 'server_activity_dest_server_id');
            $table->index('stream_id', 'server_activity_stream_id');
            $table->index('pid', 'server_activity_pid');
            $table->index('date_end', 'server_activity_date_end');
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
        Schema::dropIfExists('server_activity');
    }
};

