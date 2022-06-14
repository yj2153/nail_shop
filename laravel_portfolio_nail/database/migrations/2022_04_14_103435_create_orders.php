<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('payment_id');
            $table->string('order_number');
            $table->integer('quantity');
            $table->string('name');
            $table->string('image_file_name')->nullable();
            $table->unsignedInteger('price');
            // $table->unsignedInteger('status');
            $table->timestamps();

            $table->foreign('payment_id')->references('id')->on('payments');

            // $table->id();
            // $table->unsignedBigInteger('amount');
            // $table->foreignUuid('merchant_uid')->nullable()->constraiend('payments', 'merchant_uid');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
