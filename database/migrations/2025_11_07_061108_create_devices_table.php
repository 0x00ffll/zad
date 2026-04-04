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
        Schema::create('devices', function (Blueprint $table) {
            $table->integer('device_id')->autoIncrement();
            $table->string('device_name', 255);
            $table->string('device_key', 255);
            $table->string('device_filename', 255);
            $table->mediumText('device_header');
            $table->mediumText('device_conf');
            $table->mediumText('device_footer');
            $table->integer('default_output')->default('0');
            $table->mediumText('copy_text')->nullable();

            $table->index('device_key', 'devices_device_key');
            $table->index('default_output', 'devices_default_output');
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
        Schema::dropIfExists('devices');
    }
};

