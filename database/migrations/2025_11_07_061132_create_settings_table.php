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
        Schema::create('settings', function (Blueprint $table) {
            $table->integer('id');
            $table->mediumText('bouquet_name');
            $table->mediumText('live_streaming_pass');
            $table->mediumText('email_verify_sub');
            $table->mediumText('email_verify_cont');
            $table->mediumText('email_forgot_sub');
            $table->mediumText('email_forgot_cont');
            $table->mediumText('mail_from');
            $table->mediumText('smtp_host');
            $table->integer('smtp_port');
            $table->integer('min_password')->default('5');
            $table->integer('username_strlen')->default('15');
            $table->integer('username_alpha')->default('1');
            $table->integer('allow_multiple_accs')->default('0');
            $table->integer('allow_registrations')->default('0');
            $table->mediumText('server_name');
            $table->mediumText('smtp_username');
            $table->mediumText('smtp_password');
            $table->mediumText('email_new_pass_sub');
            $table->mediumText('logo_url');
            $table->mediumText('email_new_pass_cont');
            $table->mediumText('smtp_from_name');
            $table->integer('confirmation_email');
            $table->mediumText('smtp_encryption');
            $table->mediumText('unique_id');
            $table->integer('copyrights_removed');
            $table->mediumText('copyrights_text');
            $table->string('default_timezone', 255)->default('Europe/Athens');
            $table->string('default_locale', 20)->default('en_GB.utf8');
            $table->text('allowed_stb_types');
            $table->integer('client_prebuffer');
            $table->string('split_clients', 255);
            $table->integer('stream_max_analyze')->default('30');
            $table->integer('show_not_on_air_video');
            $table->mediumText('not_on_air_video_path');
            $table->integer('show_banned_video');
            $table->mediumText('banned_video_path');
            $table->integer('show_expired_video');
            $table->mediumText('expired_video_path');
            $table->string('mag_container', 255);
            $table->integer('probesize')->default('5000000');
            $table->mediumText('allowed_ips_admin');
            $table->integer('block_svp')->default('0');
            $table->mediumText('allow_countries');
            $table->integer('user_auto_kick_hours')->default('0');
            $table->integer('show_in_red_online')->default('0');
            $table->integer('disallow_empty_user_agents')->nullable()->default('0');
            $table->integer('show_all_category_mag')->default('1');
            $table->mediumText('default_lang')->nullable();
            $table->integer('autobackup_status')->default('0');
            $table->mediumText('autobackup_pass');
            $table->integer('flood_limit')->default('0');
            $table->mediumText('flood_ips_exclude');
            $table->integer('reshare_deny_addon')->default('0');
            $table->integer('restart_http')->default('0');
            $table->string('css_layout', 255);
            $table->integer('flood_seconds')->default('5');
            $table->integer('flood_max_attempts')->default('1');
            $table->integer('flood_apply_clients')->default('1');
            $table->integer('flood_apply_restreamers')->default('0');
            $table->integer('backup_source_all')->default('0');
            $table->integer('flood_get_block')->default('0');
            $table->integer('portal_block')->default('0');
            $table->integer('streaming_block')->default('0');
            $table->integer('stream_start_delay')->default('20000');
            $table->integer('hash_lb')->default('1');
            $table->integer('vod_bitrate_plus')->default('60');
            $table->integer('read_buffer_size')->default('8192');
            $table->string('tv_channel_default_aspect', 255)->default('fit');
            $table->integer('playback_limit')->default('3');
            $table->integer('show_tv_channel_logo')->default('1');
            $table->integer('show_channel_logo_in_preview')->default('1');
            $table->integer('enable_connection_problem_indication')->default('1');
            $table->integer('enable_pseudo_hls')->default('1');
            $table->integer('vod_limit_at')->default('0');
            $table->string('client_area_plugin', 255)->default('flow');
            $table->integer('persistent_connections')->default('0');
            $table->integer('record_max_length')->default('180');
            $table->integer('total_records_length')->default('600');
            $table->integer('max_local_recordings')->default('10');
            $table->text('allowed_stb_types_for_local_recording');
            $table->text('allowed_stb_types_rec');
            $table->integer('show_captcha')->default('1');
            $table->integer('dynamic_timezone')->default('1');
            $table->string('stalker_theme', 255)->default('digital');
            $table->integer('rtmp_random')->default('1');
            $table->text('api_ips');
            $table->string('crypt_load_balancing', 255)->default('');
            $table->integer('use_buffer')->default('0');
            $table->integer('restreamer_prebuffer')->default('0');
            $table->integer('audio_restart_loss')->default('0');
            $table->mediumText('stalker_lock_images');
            $table->string('channel_number_type', 25)->default('bouquet');
            $table->integer('stb_change_pass')->default('0');
            $table->integer('enable_debug_stalker')->default('0');
            $table->integer('online_capacity_interval')->default('10');
            $table->integer('always_enabled_subtitles')->default('1');
            $table->string('test_download_url', 255)->default('');
            $table->integer('xc_support_allow')->default('1');
            $table->string('e2_arm7a', 255)->default('');
            $table->string('e2_mipsel', 255)->default('');
            $table->string('e2_mips32el', 255)->default('');
            $table->string('e2_sh4', 255)->default('');
            $table->string('e2_arm', 255)->default('');
            $table->string('api_pass', 255);
            $table->text('message_of_day');
            $table->integer('double_auth')->default('0');
            $table->integer('mysql_remote_sec')->default('0');
            $table->integer('enable_isp_lock')->default('0');
            $table->integer('show_isps')->default('1');
            $table->longText('userpanel_mainpage');
            $table->integer('save_closed_connection')->default('1');
            $table->integer('client_logs_save')->default('1');
            $table->string('get_real_ip_client', 255);
            $table->integer('case_sensitive_line')->default('1');
            $table->integer('county_override_1st')->default('0');
            $table->integer('disallow_2nd_ip_con')->default('0');
            $table->integer('firewall')->default('0');
            $table->integer('new_sorting_bouquet')->default('1');
            $table->string('split_by', 255)->default('con');
            $table->integer('use_mdomain_in_lists')->default('0');
            $table->text('use_https');
            $table->integer('priority_backup')->default('0');
            $table->integer('use_buffer_table')->default('0');
            $table->text('tmdb_api_key');
            $table->integer('toggle_menu')->default('0');
            $table->integer('mobile_apps')->default('0');
            $table->text('stalker_container_priority');
            $table->text('gen_container_priority');
            $table->string('tmdb_default', 3)->default('en');
            $table->integer('series_custom_name')->default('0');
            $table->integer('mag_security')->default('0');
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
        Schema::dropIfExists('settings');
    }
};

