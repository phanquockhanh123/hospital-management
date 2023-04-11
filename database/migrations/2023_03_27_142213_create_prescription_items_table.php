<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prescription_id');
            $table->unsignedBigInteger('medical_id');
            $table->string('dosage');
            $table->string('dosage_note')->nullable();
            $table->string('unit');
            $table->integer('amount');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('prescription_id', 'FK_prescription_items_1')
                ->references('id')
                ->on('prescriptions')
                ->onDelete('cascade');

                $table->foreign('medical_id', 'FK_prescription_items_2')
                ->references('id')
                ->on('medicals')
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
        Schema::dropIfExists('prescription_items');
    }
}
