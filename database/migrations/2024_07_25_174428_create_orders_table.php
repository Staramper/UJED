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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('num')->nullable()->default("");
            $table->dateTime('date')->default(date("2000-01-01 00:00:00"));
            $table->string('id_user')->nullable()->default("");
            $table->decimal('total', 15,2)->nullable()->default("0.00");
            $table->string('status', 1)->nullable()->default("");
            $table->string('observations', 255)->nullable()->default("");
            $table->string('dom', 255)->nullable()->default("");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
