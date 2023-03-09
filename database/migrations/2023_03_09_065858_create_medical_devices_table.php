<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->string('medical_device_code');
            $table->string('name');
            $table->string('profile')->nullable();
            $table->string('filename')->nullable();
            $table->float('charge');
            $table->integer('status')->default(1);
            $table->date('expired_date');
            $table->integer('quantity')->default(2);
            $table->string('description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // declare foreign key
            $table->foreign('department_id', 'FK_medical_devices_1')
                ->references('id')
                ->on('doctor_departments')
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
        Schema::dropIfExists('medical_devices');
    }
}
