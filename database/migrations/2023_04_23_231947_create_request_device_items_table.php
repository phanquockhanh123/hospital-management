<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDeviceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_device_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_device_id');
            $table->unsignedBigInteger('medical_device_id');
            $table->integer('quantity');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();

            // declare foreign key
            $table->foreign('request_device_id', 'FK_request_device_items_1')
                ->references('id')
                ->on('request_devices')
                ->onDelete('cascade');
            $table->foreign('medical_device_id', 'FK_request_device_items_2')
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
        Schema::dropIfExists('request_device_items');
    }
}
