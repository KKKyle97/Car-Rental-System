<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->date('rentStartDate')->index();
            $table->date('rentEndDate')->index();
            $table->time('rentStartTime')->index();
            $table->time('rentEndTime')->index();
            $table->double('total')->index();
            $table->integer('car_id')->foreign()->references('id')->on('cars');
            $table->integer('customer_id')->foreign()->references('id')->on('customers');
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
        Schema::dropIfExists('rental_orders');
    }
}
