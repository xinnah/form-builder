<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('form_id')->unsigned();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Schema::table('customer_info', function($table) {
           $table->foreign('user_id')->references('id')->on('users');
           $table->foreign('form_id')->references('id')->on('forms');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_info');
    }
}
