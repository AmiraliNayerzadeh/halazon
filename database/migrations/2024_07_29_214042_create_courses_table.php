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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('image')->nullable();
            $table->longText('description')->nullable();

            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('users')->cascadeOnDelete();

            $table->integer('age_from')->nullable();
            $table->integer('age_to')->nullable();


            $table->integer('class_duration')->nullable();
            $table->integer('weeks')->nullable();
            $table->integer('minutes')->nullable();

            $table->unsignedBigInteger('capacity')->nullable();
            $table->unsignedBigInteger('remain_capacity')->nullable();

            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('discount_price')->nullable();


            $table->string('status')->nullable();
            $table->boolean('is_draft') ;


            $table->text('slug');
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });




        Schema::create('category_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('course_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_course');
        Schema::dropIfExists('courses');
    }
};
