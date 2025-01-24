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
        Schema::table('headlines', function (Blueprint $table) {
            $table->boolean('is_move_video')->default(0) ;
            $table->text('arvan_video_id')->nullable() ;
            $table->text('arvan_video_url')->nullable() ;
            $table->text('arvan_video_player')->nullable() ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('headlines', function (Blueprint $table) {
            $table->dropColumn('is_move_video');
            $table->dropColumn('arvan_video_id');
            $table->dropColumn('arvan_video_url');
            $table->dropColumn('arvan_video_player');
        });
    }
};
