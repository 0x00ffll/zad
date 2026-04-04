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
        Schema::create('streams_arguments', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('argument_cat', 255);
            $table->string('argument_name', 255);
            $table->mediumText('argument_description');
            $table->string('argument_wprotocol', 255)->nullable();
            $table->string('argument_key', 255);
            $table->string('argument_cmd', 255)->nullable();
            $table->string('argument_type', 255);
            $table->string('argument_default_value', 255)->nullable();            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streams_arguments');
    }
};

