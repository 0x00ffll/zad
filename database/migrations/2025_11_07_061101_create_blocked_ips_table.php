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
        Schema::create('blocked_ips', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('ip', 39);
            $table->mediumText('notes');
            $table->integer('date');
            $table->integer('attempts_blocked');            $table->unique('ip', 'blocked_ips_ip_2');
            $table->unique('ip', 'blocked_ips_ip_3');
            $table->index('ip', 'blocked_ips_ip');
            $table->index('date', 'blocked_ips_date');
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
        Schema::dropIfExists('blocked_ips');
    }
};

