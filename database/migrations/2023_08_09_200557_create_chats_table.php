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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cht_orig');
            $table->unsignedBigInteger('cht_dest');
            $table->unsignedBigInteger('cht_business');
            // $table->foreign('cht_orig')->references('id')->on('users');
            // $table->foreign('cht_business')->references('id')->on('businesses');
            $table->string('cht_message', 255)->nullable()->default("");
            $table->dateTime('cht_fecha_hora')->default(date("2000-01-01 00:00:00"));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
