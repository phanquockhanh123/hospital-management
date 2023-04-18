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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('doctor_department_id');
            $table->string('blood_group');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('profile')->nullable();
            $table->string('filename')->nullable();
            $table->integer('gender')->default(0);
            $table->string('email')->unique();
            $table->date('date_of_birth')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('designation')->nullable();
            $table->string('academic_level')->nullable();
            $table->string('identity_number')->unique();
            $table->date('identity_card_date')->nullable();
            $table->string('identity_card_place')->nullable();
            $table->date('start_work_date')->nullable();
            $table->string('specialist')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // declare foreign key
            
            $table->foreign('doctor_department_id', 'FK_doctors_1')
                ->references('id')
                ->on('doctor_departments')
                ->onDelete('cascade');

            $table->foreign('user_id', 'FK_doctors_2')
                ->references('id')
                ->on('users')
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
