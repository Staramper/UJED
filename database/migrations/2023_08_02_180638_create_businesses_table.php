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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bsn_socio');
            // $table->foreign('bsn_socio')->references('id')->on('users');
            $table->string('bsn_title', 200)->nullable()->default("");
            $table->string('bsn_logo', 120)->nullable()->default("");
            $table->string('bsn_desc', 250)->nullable()->default("");
            $table->string('bsn_status', 2)->nullable()->default("");
            $table->string('bsn_horario', 200)->nullable()->default("");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
