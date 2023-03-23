<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('main_disease');
            $table->string('side_disease')->nullable();
            $table->string('medical_name');
            $table->string('dosage');
            $table->string('dosage_note')->nullable();
            $table->string('unit');
            $table->integer('amount');
            $table->string('note');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('doctor_id', 'FK_prescriptions_2')
                ->references('id')
                ->on('doctors')
                ->onDelete('cascade');
            $table->foreign('patient_id', 'FK_prescriptions_3')
                ->references('id')
                ->on('patients')
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
        Schema::dropIfExists('prescriptions');
    }
}
