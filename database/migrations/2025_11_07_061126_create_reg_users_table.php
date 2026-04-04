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
        Schema::create('reg_users', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('username', 50);
            $table->string('password', 255);
            $table->string('email', 255);
            $table->string('ip', 255)->nullable();
            $table->integer('date_registered');
            $table->mediumText('verify_key')->nullable();
            $table->integer('last_login')->nullable();
            $table->integer('member_group_id');
            $table->integer('verified')->default('0');
            $table->float('credits')->default('0');
            $table->mediumText('notes')->nullable();
            $table->integer('status')->default('1');
            $table->mediumText('default_lang');
            $table->text('reseller_dns');
            $table->integer('owner_id')->default('0');
            $table->text('override_packages')->nullable();
            $table->string('google_2fa_sec', 50);

            $table->index('member_group_id', 'reg_users_member_group_id');
            $table->index('username', 'reg_users_username');
            $table->index('password', 'reg_users_password');
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
        Schema::dropIfExists('reg_users');
    }
};

