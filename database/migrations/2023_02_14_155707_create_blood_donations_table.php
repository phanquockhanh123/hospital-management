<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blood_donor_id');
            $table->integer('bags');
            $table->timestamps();
            $table->softDeletes();

            // declare foreign key
            $table->foreign('blood_donor_id', 'FK_blood_donations_1')
                ->references('id')
                ->on('blood_donors')
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
        Schema::dropIfExists('blood_donations');
    }
}
