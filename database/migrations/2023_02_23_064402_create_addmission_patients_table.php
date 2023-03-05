<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddmissionPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addmission_patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('bed_id');
            $table->date('addmission_date');
            $table->string('reason')->nullable();
            $table->string('health_condition')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_relation')->nullable();
            $table->integer('guardian_contact')->nullable();
            $table->string('guardian_address')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // declare foreign key
            $table->foreign('doctor_id', 'FK_addmission_patient_1')
                ->references('id')
                ->on('doctors')
                ->onDelete('cascade');

            $table->foreign('patient_id', 'FK_addmission_patient_2')
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');


            $table->foreign('bed_id', 'FK_addmission_patient_3')
                ->references('id')
                ->on('beds')
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
        Schema::dropIfExists('addmission_patients');
    }
}
