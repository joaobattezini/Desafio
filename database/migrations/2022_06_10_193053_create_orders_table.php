<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->bigInteger('id_client')->unsigned();
            $table->bigInteger('id_table')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->integer('total_price');
            $table->string('status');

            $table->foreign('id_client')->references('id')->on('clients');
            $table->foreign('id_table')->references('id')->on('tables');
            $table->foreign('id_user')->references('id')->on('users');

            $table->timestamps();
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
};
