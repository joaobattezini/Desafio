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
        Schema::create('menus_items', function (Blueprint $table) {
            $table->bigInteger('menu_id')->unsigned();
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus')
                ->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus_itens');
    }
};
