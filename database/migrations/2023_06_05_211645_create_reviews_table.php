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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('u_id')->comment('ユーザーID');  // 追加
            $table->unsignedBigInteger('book_id')->comment('本のID');  // 追加
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->integer('score')->nullable()->comment('点数');
            $table->text('review')->nullable()->comment('本の感想');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
