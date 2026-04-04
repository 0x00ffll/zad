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
        Schema::create('member_groups', function (Blueprint $table) {
            $table->integer('group_id')->autoIncrement();
            $table->mediumText('group_name');
            $table->string('group_color', 7)->default('#000000');
            $table->integer('is_banned')->default('0');
            $table->integer('is_admin')->default('0');
            $table->integer('is_reseller');
            $table->integer('total_allowed_gen_trials')->default('0');
            $table->string('total_allowed_gen_in', 255);
            $table->integer('delete_users')->default('0');
            $table->text('allowed_pages');
            $table->integer('can_delete')->default('1');
            $table->integer('reseller_force_server')->default('0');
            $table->float('create_sub_resellers_price')->default('0');
            $table->integer('create_sub_resellers')->default('0');
            $table->integer('alter_packages_ids')->default('0');
            $table->integer('alter_packages_prices')->default('0');
            $table->integer('reseller_client_connection_logs')->default('0');
            $table->integer('reseller_assign_pass')->default('0');
            $table->integer('allow_change_pass')->default('0');
            $table->integer('allow_import')->default('0');
            $table->integer('allow_export')->default('0');
            $table->integer('reseller_trial_credit_allow')->default('0');
            $table->integer('edit_mac')->default('0');
            $table->integer('edit_isplock')->default('0');
            $table->integer('reset_stb_data')->default('0');
            $table->integer('reseller_bonus_package_inc')->default('0');
            $table->integer('allow_download')->default('1');

            $table->index('is_admin', 'member_groups_is_admin');
            $table->index('is_banned', 'member_groups_is_banned');
            $table->index('is_reseller', 'member_groups_is_reseller');
            $table->index('can_delete', 'member_groups_can_delete');
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
        Schema::dropIfExists('member_groups');
    }
};

