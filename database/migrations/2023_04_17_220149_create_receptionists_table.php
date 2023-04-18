<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptionistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptionists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('profile')->nullable();
            $table->string('filename')->nullable();
            $table->integer('gender')->default(0);
            $table->date('date_of_birth')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('designation')->nullable();
            $table->string('identity_number')->unique();
            $table->date('identity_card_date')->nullable();
            $table->string('identity_card_place')->nullable();
            $table->date('start_work_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id', 'FL_receptionist_1')
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
        Schema::dropIfExists('receptionists');
    }
}
