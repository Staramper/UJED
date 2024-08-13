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
        Schema::create('quejas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('qjs_user');
            $table->unsignedBigInteger('qjs_business');
            // $table->foreign('qjs_user')->references('id')->on('users');
            // $table->foreign('qjs_business')->references('id')->on('businesses');
            $table->string('qjs_queja', 250)->nullable()->default("");
            $table->string('qjs_response', 250)->nullable()->default("");
            $table->dateTime('qjs_fecha_hora')->default(date("2000-01-01 00:00:00"));
            $table->string('qjs_status', 1)->nullable()->default("");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quejas');
    }
};
