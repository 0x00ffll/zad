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
        Schema::create('streams', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('type');
            $table->integer('category_id')->nullable();
            $table->mediumText('stream_display_name');
            $table->mediumText('stream_source')->nullable();
            $table->mediumText('stream_icon');
            $table->mediumText('notes')->nullable();
            $table->integer('created_channel_location')->nullable();
            $table->integer('enable_transcode')->default('0');
            $table->mediumText('transcode_attributes');
            $table->mediumText('custom_ffmpeg');
            $table->mediumText('movie_propeties')->nullable();
            $table->mediumText('movie_subtitles');
            $table->integer('read_native')->default('1');
            $table->text('target_container')->nullable();
            $table->integer('stream_all')->default('0');
            $table->integer('remove_subtitles')->default('0');
            $table->string('custom_sid', 150)->nullable();
            $table->integer('epg_id')->nullable();
            $table->string('channel_id', 255)->nullable();
            $table->string('epg_lang', 255)->nullable();
            $table->integer('order')->default('0');
            $table->text('auto_restart');
            $table->integer('transcode_profile_id')->default('0');
            $table->mediumText('pids_create_channel');
            $table->mediumText('cchannel_rsources');
            $table->integer('gen_timestamps')->default('1');
            $table->integer('added');
            $table->integer('series_no')->default('0');
            $table->integer('direct_source')->default('0');
            $table->integer('tv_archive_duration')->default('0');
            $table->integer('tv_archive_server_id')->default('0');
            $table->integer('tv_archive_pid')->default('0');
            $table->integer('movie_symlink')->default('0');
            $table->integer('redirect_stream')->default('0');
            $table->integer('rtmp_output')->default('0');
            $table->integer('number');
            $table->integer('allow_record')->default('0');
            $table->integer('probesize_ondemand')->default('128000');
            $table->text('custom_map');
            $table->mediumText('external_push');
            $table->integer('delay_minutes')->default('0');

            $table->index('type', 'streams_type');
            $table->index('category_id', 'streams_category_id');
            $table->index('created_channel_location', 'streams_created_channel_location');
            $table->index('enable_transcode', 'streams_enable_transcode');
            $table->index('read_native', 'streams_read_native');
            $table->index('epg_id', 'streams_epg_id');
            $table->index('channel_id', 'streams_channel_id');
            $table->index('transcode_profile_id', 'streams_transcode_profile_id');
            $table->index('order', 'streams_order');
            $table->index('direct_source', 'streams_direct_source');
            $table->index('rtmp_output', 'streams_rtmp_output');
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
        Schema::dropIfExists('streams');
    }
};

