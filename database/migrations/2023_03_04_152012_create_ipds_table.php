<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipds', function (Blueprint $table) {
            $table->id();
            $table->string('ipd_code')->unique();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('bed_id');
            $table->string('blood_group');
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->date('addmission_date');
            $table->string('symptoms')->nullable();
            $table->string('notes')->nullable();
            $table->integer('patient_status');
            $table->integer('is_old_patient');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ipds');
    }
}
