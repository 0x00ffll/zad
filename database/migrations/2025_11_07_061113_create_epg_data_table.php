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
        Schema::create('epg_data', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('epg_id');
            $table->string('title', 255);
            $table->string('lang', 10);
            $table->timestamp('start');
            $table->timestamp('end')->default('0000-00-00 00:00:00');
            $table->mediumText('description');
            $table->string('channel_id', 50);

            $table->index('epg_id', 'epg_data_epg_id');
            $table->index('start', 'epg_data_start');
            $table->index('end', 'epg_data_end');
            $table->index('lang', 'epg_data_lang');
            $table->index('channel_id', 'epg_data_channel_id');
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
        Schema::dropIfExists('epg_data');
    }
};

