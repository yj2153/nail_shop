<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('secondary_category_id');
            $table->string('name');
            $table->string('image_file_name')->nullable();
            $table->text('description');
            $table->unsignedInteger('price');
            $table->integer('default')->default(0);
            $table->timestamps();

            $table->foreign('secondary_category_id')->references('id')->on('secondary_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
