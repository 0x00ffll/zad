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
        Schema::create('mag_devices', function (Blueprint $table) {
            $table->integer('mag_id')->autoIncrement();
            $table->integer('user_id');
            $table->integer('bright')->default('200');
            $table->integer('contrast')->default('127');
            $table->integer('saturation')->default('127');
            $table->mediumText('aspect');
            $table->string('video_out', 20)->default('rca');
            $table->integer('volume')->default('50');
            $table->integer('playback_buffer_bytes')->default('0');
            $table->integer('playback_buffer_size')->default('0');
            $table->integer('audio_out')->default('1');
            $table->string('mac', 50);
            $table->string('ip', 20)->nullable();
            $table->string('ls', 20)->nullable();
            $table->string('ver', 300)->nullable();
            $table->string('lang', 50)->nullable();
            $table->string('locale', 30)->default('en_GB.utf8');
            $table->integer('city_id')->nullable()->default('0');
            $table->integer('hd')->default('1');
            $table->integer('main_notify')->default('1');
            $table->integer('fav_itv_on')->default('0');
            $table->integer('now_playing_start')->nullable();
            $table->integer('now_playing_type')->default('0');
            $table->string('now_playing_content', 50)->nullable();
            $table->integer('time_last_play_tv')->nullable();
            $table->integer('time_last_play_video')->nullable();
            $table->integer('hd_content')->default('1');
            $table->string('image_version', 350)->nullable();
            $table->integer('last_change_status')->nullable();
            $table->integer('last_start')->nullable();
            $table->integer('last_active')->nullable();
            $table->integer('keep_alive')->nullable();
            $table->integer('playback_limit')->default('3');
            $table->integer('screensaver_delay')->default('10');
            $table->string('stb_type', 20);
            $table->string('sn', 255)->nullable();
            $table->integer('last_watchdog')->nullable();
            $table->integer('created');
            $table->string('country', 5)->nullable();
            $table->integer('plasma_saving')->default('0');
            $table->integer('ts_enabled')->nullable()->default('0');
            $table->integer('ts_enable_icon')->default('1');
            $table->string('ts_path', 35)->nullable();
            $table->integer('ts_max_length')->default('3600');
            $table->string('ts_buffer_use', 15)->default('cyclic');
            $table->string('ts_action_on_exit', 20)->default('no_save');
            $table->string('ts_delay', 20)->default('on_pause');
            $table->string('video_clock', 10)->default('Off');
            $table->integer('rtsp_type')->default('4');
            $table->integer('rtsp_flags')->default('0');
            $table->string('stb_lang', 15)->default('en');
            $table->integer('display_menu_after_loading')->default('1');
            $table->integer('record_max_length')->default('180');
            $table->integer('plasma_saving_timeout')->default('600');
            $table->integer('now_playing_link_id')->nullable();
            $table->integer('now_playing_streamer_id')->nullable();
            $table->string('device_id', 255)->nullable();
            $table->string('device_id2', 255)->nullable();
            $table->string('hw_version', 255)->nullable();
            $table->string('parent_password', 20)->default('0000');
            $table->integer('spdif_mode')->default('1');
            $table->string('show_after_loading', 60)->default('main_menu');
            $table->integer('play_in_preview_by_ok')->default('1');
            $table->integer('hdmi_event_reaction')->default('1');
            $table->string('mag_player', 20)->nullable()->default('ffmpeg');
            $table->string('play_in_preview_only_by_ok', 10)->default('true');
            $table->integer('watchdog_timeout');
            $table->mediumText('fav_channels');
            $table->mediumText('tv_archive_continued');
            $table->string('tv_channel_default_aspect', 255)->default('fit');
            $table->integer('last_itv_id')->default('0');
            $table->string('units', 20)->nullable()->default('metric');
            $table->string('token', 32)->nullable()->default('');
            $table->integer('lock_device')->default('0');

            $table->index('user_id', 'mag_devices_user_id');
            $table->index('mac', 'mag_devices_mac');
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
        Schema::dropIfExists('mag_devices');
    }
};

