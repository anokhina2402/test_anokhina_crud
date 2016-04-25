<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('last_booked', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date');
            $table->integer('duration');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('vehicle');
            $table->string('email_address');
            $table->string('address');
            $table->string('pc');
            $table->string('city');
            $table->string('phone');
            $table->boolean('newsletter');
            $table->boolean('confirmed');
            $table->string('payment_link');
            $table->string('driver');
            $table->string('payment_confirmed');
            $table->integer('coupon_id');
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
        Schema::drop('last_booked');
    }
}
