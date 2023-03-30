<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('medical_device_id');
            $table->integer('quantity');
            $table->dateTime('borrow_time');
            $table->dateTime('return_time');
            $table->string('description');
            $table->string('status')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // declare foreign key
            $table->foreign('doctor_id', 'FK_request_devices_1')
                ->references('id')
                ->on('doctors')
                ->onDelete('cascade');

            $table->foreign('patient_id', 'FK_request_devices_2')
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');

            $table->foreign('medical_device_id', 'FK_request_devices_3')
                ->references('id')
                ->on('medical_devices')
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
        Schema::dropIfExists('request_devices');
    }
}
