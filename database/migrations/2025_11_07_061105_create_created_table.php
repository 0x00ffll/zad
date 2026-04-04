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
        Schema::create('created', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('type');
            $table->integer('category_id');
            $table->integer('stream_display_name');
            $table->integer('stream_source');
            $table->integer('stream_icon');
            $table->integer('notes');
            $table->integer('created_channel_location');
            $table->integer('enable_transcode');
            $table->integer('transcode_attributes');
            $table->integer('custom_ffmpeg');
            $table->integer('movie_propeties');
            $table->integer('movie_subtitles');
            $table->integer('read_native');
            $table->integer('target_container');
            $table->integer('stream_all');
            $table->integer('remove_subtitles');
            $table->integer('custom_sid');
            $table->integer('epg_id');
            $table->integer('channel_id');
            $table->integer('epg_lang');
            $table->integer('order');
            $table->integer('auto_restart');
            $table->integer('transcode_profile_id');
            $table->integer('pids_create_channel');
            $table->integer('cchannel_rsources');
            $table->integer('gen_timestamps');
            $table->integer('added');
            $table->integer('series_no');
            $table->integer('direct_source');
            $table->integer('tv_archive_duration');
            $table->integer('tv_archive_server_id');
            $table->integer('tv_archive_pid');
            $table->integer('movie_symlink');
            $table->integer('redirect_stream');
            $table->integer('rtmp_output');
            $table->integer('number');
            $table->integer('allow_record');
            $table->integer('probesize_ondemand');
            $table->integer('custom_map');
            $table->integer('external_push');
            $table->integer('delay_minutes');
            // Note: Original table used MyISAM, converted to InnoDB
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('created');
    }
};

