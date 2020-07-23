<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('fullName',50)->index();
            $table->string('icNumber',12)->unique()->index();
            $table->string('telephoneNo',10)->index();
            $table->string('driverLicenseNumber',12)->unique()->index();
            $table->string('address',100)->index();
            $table->string('city',100)->index();
            $table->string('state',2)->index();
            $table->string('zipCode',5)->index();
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
        Schema::dropIfExists('customers');
    }
}
