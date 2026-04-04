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
        Schema::create('mag_events', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('status')->default('0');
            $table->integer('mag_device_id');
            $table->string('event', 20);
            $table->integer('need_confirm')->default('0');
            $table->mediumText('msg');
            $table->integer('reboot_after_ok')->default('0');
            $table->integer('auto_hide_timeout')->nullable()->default('0');
            $table->integer('send_time');
            $table->integer('additional_services_on')->default('1');
            $table->integer('anec')->default('0');
            $table->integer('vclub')->default('0');

            $table->index('status', 'mag_events_status');
            $table->index('mag_device_id', 'mag_events_mag_device_id');
            $table->index('event', 'mag_events_event');
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
        Schema::dropIfExists('mag_events');
    }
};

