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
        Schema::create('streaming_servers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('server_name', 255);
            $table->string('domain_name', 255);
            $table->string('server_ip', 255)->nullable();
            $table->string('vpn_ip', 255);
            $table->mediumText('ssh_password')->nullable();
            $table->integer('ssh_port')->nullable();
            $table->integer('diff_time_main')->default('0');
            $table->integer('http_broadcast_port');
            $table->integer('total_clients')->default('0');
            $table->string('system_os', 255)->nullable();
            $table->string('network_interface', 255);
            $table->float('latency')->default('0');
            $table->integer('status')->default('-1');
            $table->integer('enable_geoip')->default('0');
            $table->mediumText('geoip_countries');
            $table->integer('last_check_ago')->default('0');
            $table->integer('can_delete')->default('1');
            $table->text('server_hardware');
            $table->integer('total_services')->default('3');
            $table->integer('persistent_connections')->default('0');
            $table->integer('rtmp_port')->default('8001');
            $table->string('geoip_type', 13)->default('low_priority');
            $table->mediumText('isp_names');
            $table->string('isp_type', 13)->default('low_priority');
            $table->integer('enable_isp')->default('0');
            $table->integer('boost_fpm')->default('0');
            $table->text('http_ports_add');
            $table->integer('network_guaranteed_speed')->default('0');
            $table->integer('https_broadcast_port')->default('25463');
            $table->text('https_ports_add');
            $table->text('whitelist_ips');
            $table->mediumText('watchdog_data');
            $table->integer('timeshift_only')->default('0');

            $table->index('total_clients', 'streaming_servers_total_clients');
            $table->index('status', 'streaming_servers_status');
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
        Schema::dropIfExists('streaming_servers');
    }
};

