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
        Schema::create('tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('code', 4);

            $table->text('phone')->nullable();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete();

            $table->boolean('used')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokens');
    }
};
