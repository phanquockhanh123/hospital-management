<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosisItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diagnosis_id');
            $table->string('diagnosis_name');
            $table->string('result');
            $table->string('references_range')->nullable();
            $table->string('unit');
            $table->string('method');
            $table->string('diagnosis_note');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('diagnosis_id', 'FK_diagnosis_items_2')
                ->references('id')
                ->on('diagnosis')
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
        Schema::dropIfExists('diagnosis_items');
    }
}
