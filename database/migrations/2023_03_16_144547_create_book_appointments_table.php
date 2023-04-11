<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->string('fullname');
            $table->string('phone');
            $table->string('email');
            $table->string('reason');
            $table->datetime('experted_time');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();

            // declare foreign key
            $table->foreign('appointment_id', 'FK_book_appointments_1')
                ->references('id')
                ->on('appointments')
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
        Schema::dropIfExists('book_appointments');
    }
}
