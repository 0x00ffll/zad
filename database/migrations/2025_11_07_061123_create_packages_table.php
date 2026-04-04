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
        Schema::create('packages', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('package_name', 255);
            $table->integer('is_trial');
            $table->integer('is_official');
            $table->float('trial_credits');
            $table->float('official_credits');
            $table->integer('trial_duration');
            $table->string('trial_duration_in', 255);
            $table->integer('official_duration');
            $table->string('official_duration_in', 255);
            $table->mediumText('groups');
            $table->mediumText('bouquets');
            $table->integer('can_gen_mag')->default('0');
            $table->integer('only_mag')->default('0');
            $table->mediumText('output_formats');
            $table->integer('is_isplock')->default('0');
            $table->integer('max_connections')->default('1');
            $table->integer('is_restreamer')->default('0');
            $table->integer('force_server_id')->default('0');
            $table->integer('can_gen_e2')->default('0');
            $table->integer('only_e2')->default('0');
            $table->string('forced_country', 2);
            $table->integer('lock_device')->default('0');

            $table->index('is_trial', 'packages_is_trial');
            $table->index('is_official', 'packages_is_official');
            $table->index('can_gen_mag', 'packages_can_gen_mag');
            $table->index('can_gen_e2', 'packages_can_gen_e2');
            $table->index('only_e2', 'packages_only_e2');
            $table->index('only_mag', 'packages_only_mag');
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
        Schema::dropIfExists('packages');
    }
};

