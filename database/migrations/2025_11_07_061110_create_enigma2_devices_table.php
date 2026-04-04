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
        Schema::create('enigma2_devices', function (Blueprint $table) {
            $table->integer('device_id')->autoIncrement();
            $table->string('mac', 255);
            $table->integer('user_id');
            $table->string('modem_mac', 255);
            $table->string('local_ip', 255);
            $table->string('public_ip', 255);
            $table->string('key_auth', 255);
            $table->string('enigma_version', 255);
            $table->string('cpu', 255);
            $table->string('version', 255);
            $table->text('lversion');
            $table->string('token', 32);
            $table->integer('last_updated');
            $table->integer('watchdog_timeout');
            $table->integer('lock_device')->default('0');
            $table->integer('telnet_enable')->default('1');
            $table->integer('ftp_enable')->default('1');
            $table->integer('ssh_enable')->default('1');
            $table->string('dns', 255);
            $table->string('original_mac', 255);
            $table->integer('rc')->default('1');

            $table->index('mac', 'enigma2_devices_mac');
            $table->index('user_id', 'enigma2_devices_user_id');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enigma2_devices');
    }
};

