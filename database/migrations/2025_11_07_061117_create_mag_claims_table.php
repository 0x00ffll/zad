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
        Schema::create('mag_claims', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('mag_id');
            $table->integer('stream_id');
            $table->string('real_type', 10);
            $table->dateTime('date');

            $table->index('mag_id', 'mag_claims_mag_id');
            $table->index('stream_id', 'mag_claims_stream_id');
            $table->index('real_type', 'mag_claims_real_type');
            $table->index('date', 'mag_claims_date');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mag_claims');
    }
};

