<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_donors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('blood_group_id');
            $table->date('date_of_birth');
            $table->tinyInteger('gender');
            $table->timestamps();
            $table->softDeletes();

            // declare foreign key
            $table->foreign('blood_group_id', 'FK_blood_donors_1')
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
        Schema::dropIfExists('blood_donors');
    }
}
