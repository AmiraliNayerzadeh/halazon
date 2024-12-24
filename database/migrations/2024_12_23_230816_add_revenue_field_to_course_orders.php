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
        Schema::table('course_orders', function (Blueprint $table) {
            $table->integer('revenue')->default(70);
            $table->boolean('is_settled')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_orders', function (Blueprint $table) {
            $table->dropColumn('revenue');
            $table->dropColumn('is_settled');

        });
    }
};
