<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('user_name');
            $table->string('user_phone');
            // $table->string('imp_uid')->unique()->nullable();
            $table->unsignedInteger('total_price')->default(0);
            $table->unsignedInteger('cancel_price')->default(0);
            $table->string('order_number');
            // $table->string('pay_method')->default('card');
            $table->string('status')->default('0');
            $table->timestamps();

            // $table->uuid('merchant_uid')->primary();
            // $table->string('imp_uid')->unique()->nullable();
            // $table->unsignedBigInteger('amount')->default(0);
            // $table->unsignedBigInteger('cancel_amount')->default(0);
            // $table->string('pay_method')->default('card');
            // $table->string('status')->default('unpaid');
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
        Schema::dropIfExists('payments');
    }
}
