<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('card_id')->unsigned();
            $table->bigInteger('sku_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->tinyInteger('is_purchase')->unsigned()->nullable();
            $table->tinyInteger('is_sell')->unsigned()->nullable();
            $table->date('purchase_date');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_items');
    }
}
