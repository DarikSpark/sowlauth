<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('statusClient')->default('1');
            $table->string('lastName')->nullable();
            $table->string('secondName')->nullable();
            $table->string('firstName')->nullable();
            $table->string('sex')->nullable();
            $table->string('company')->nullable();
            $table->string('carier')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->string('web')->nullable();
            $table->string('skype')->nullable();
            $table->string('address')->nullable();
            $table->string('verificity')->default('1');
            $table->string('active')->default('1');
            
            //$table->string('photo')->nullable();
            $table->date('birthday')->nullable();
            //$table->integer('country_id')->unsigned()->nullable();
            //$table->foreign('country_id')->references('id')->on('countries');
            //$table->text('comment');
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
        Schema::drop('clients');
    }
}
