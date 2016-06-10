<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBouquetPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bouquet_purchase', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bouquet_id')->unsigned()->index();
            $table->integer('purchase_id')->unsigned()->index();
            $table->string('count')->default('1');
            $table->unique(['bouquet_id', 'purchase_id'], 'bouquet_purchase_unique');
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
        Schema::drop('bouquet_purchase');
    }
}
