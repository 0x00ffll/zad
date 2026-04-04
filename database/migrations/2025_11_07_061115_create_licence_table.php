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
        Schema::create('licence', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('licence_key', 29);
            $table->integer('show_message');
            $table->integer('update_available')->default('0');
            $table->integer('reshare_deny_addon')->nullable()->default('0');            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licence');
    }
};

