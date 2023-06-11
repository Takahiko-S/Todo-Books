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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('u_id')->comment('ユーザーID');
            $table->string('title')->comment('本のタイトル');
            $table->string('sakusya')->comment('作者名');
            $table->date('readend')->nullable()->comment('読書終了日');
            $table->string('image_path')->nullable()->comment('画像名');
            $table->timestamps();
            $table->foreign('u_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
