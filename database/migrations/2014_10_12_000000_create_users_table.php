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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nick', 80)->unique()->nullable()->default("");
            $table->string('tel', 10)->unique()->nullable()->default("");
            $table->string('email')->unique();
            $table->string('role')->default('user');
            $table->string('cp')->nullable()->default('');
            $table->string('state')->nullable()->default('');
            $table->string('municipality')->nullable()->default('');
            $table->string('cologne')->nullable()->default('');
            $table->string('street')->nullable()->default('');
            $table->string('outer_number')->nullable()->default('');
            $table->string('interior_number')->nullable()->default('');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
