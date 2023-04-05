<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->string('medical_code');
            $table->string('medical_name');
            $table->string('unit');
            $table->string('use');
            $table->integer('quantity');
            $table->float('import_price');
            $table->float('export_price');
            $table->integer('amount_day');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();

             // declare foreign key
             $table->foreign('department_id', 'FK_medicals_1')
             ->references('id')
             ->on('doctor_departments')
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
        Schema::dropIfExists('medicals');
    }
}
