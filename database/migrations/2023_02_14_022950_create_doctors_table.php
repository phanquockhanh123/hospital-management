<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_department_id');
            $table->unsignedBigInteger('blood_group_id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('profile')->nullable();
            $table->integer('gender')->default(0);
            $table->string('email')->unique();
            $table->date('date_of_birth')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('designation')->nullable();
            $table->string('academic_level')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // declare foreign key
            $table->foreign('doctor_department_id', 'FK_doctors_1')
                ->references('id')
                ->on('doctor_departments')
                ->onDelete('cascade');
            $table->foreign('blood_group_id', 'FK_doctors_2')
                ->references('id')
                ->on('blood_groups')
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
        Schema::dropIfExists('doctors');
    }
}
