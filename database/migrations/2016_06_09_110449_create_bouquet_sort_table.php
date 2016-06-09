<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBouquetSortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bouquet_sort', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bouquet_id')->unsigned()->index();
            $table->integer('sort_id')->unsigned()->index();
            $table->string('count')->default('1');
            $table->unique(['bouquet_id', 'sort_id'], 'bouquet_sort_unique');
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
        Schema::drop('bouquet_sort');
    }
}
