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
            $table->string('name')->nullable();
            $table->string('family')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->boolean('is_teacher')->default(0);
            $table->integer('nationalCode')->nullable();
            $table->text('id_card')->nullable();
            $table->text('birthday')->nullable();
            $table->longText('address')->nullable();
            $table->integer('postalCode')->nullable();
            $table->text('avatar')->nullable();
            $table->text('video')->nullable();
            $table->longText('description')->nullable();
            $table->text('last_certificate')->nullable();
            $table->text('resume')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_verify')->nullable();
            $table->string('slug')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
