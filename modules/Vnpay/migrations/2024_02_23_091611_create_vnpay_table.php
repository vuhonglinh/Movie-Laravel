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
        Schema::create('vnpay', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code'); //Mã đơn hàng
            $table->bigInteger('amount'); //Tổng tiền
            $table->string('bank_code');
            $table->string('card_type');
            $table->string('order_info');
            $table->string('tmn_code');
            $table->unsignedInteger('order_id');
            $table->timestamps();

            //Thiết lập khóa
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vnpay');
    }
};
