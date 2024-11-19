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
        Schema::create('supports', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();

            $table->unsignedBigInteger('user_id')->nullable() ;
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('responder')->nullable() ;
            $table->foreign('responder')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('supportable_id');
            $table->string('supportable_type') ;



            $table->text('message');


            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');

            $table->string('status')->default('open');
//            in:open,in-progress,closed , answered

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};
