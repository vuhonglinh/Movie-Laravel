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
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); //Tên phim
            $table->string('thumbnail'); //ảnh
            $table->string('slug'); //slug
            $table->text('description'); //mô tả
            $table->string('directors'); //đạo diẽn
            $table->string('quality'); //chất lượng
            $table->date('release_date'); //ngày phát hành
            $table->text("trailer_url"); //đường dẫn trailer
            $table->text("movie_url")->nullable(); //đường dẫn trailer
            $table->boolean('is_series')->default(0); // 0: phim lẻ, 1: phim bộ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
