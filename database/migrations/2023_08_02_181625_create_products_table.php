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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prd_business');
            // $table->foreign('prd_business')->references('id')->on('businesses');
            $table->string('prd_title', 200)->nullable()->default("");
            $table->string('prd_picture', 120)->nullable()->default("");
            $table->string('prd_desc', 250)->nullable()->default("");
            $table->string('prd_details', 250)->nullable()->default("");
            $table->decimal('prd_price', 15,2)->nullable()->default("0.00");
            $table->string('prd_status', 2)->nullable()->default("");
            $table->string('prd_type', 1)->nullable()->default("");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
