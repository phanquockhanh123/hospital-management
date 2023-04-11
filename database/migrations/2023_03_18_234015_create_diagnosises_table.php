<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('main_diagnosis');
            $table->string('status');
            $table->string('side_diagnosis')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('doctor_id', 'FK_diagnosis_2')
                ->references('id')
                ->on('doctors')
                ->onDelete('cascade');
            $table->foreign('patient_id', 'FK_diagnosis_3')
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
        Schema::dropIfExists('diagnosis');
    }
}
