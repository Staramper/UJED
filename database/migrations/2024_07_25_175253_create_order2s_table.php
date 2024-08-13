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
        Schema::create('order2s', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('num_order')->nullable()->default("");
            $table->string('partida')->nullable()->default("");
            $table->string('id_product')->nullable()->default("");
            $table->string('title')->nullable()->default("");
            $table->string('picture', 120)->nullable()->default("");
            $table->decimal('amount', 15,2)->nullable()->default("0.00");
            $table->string('desc', 250)->nullable()->default("");
            $table->decimal('price', 15,2)->nullable()->default("0.00");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order2s');
    }
};
