<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prescription_id')->nullable();
            $table->unsignedBigInteger('diagnosis_id')->nullable();
            $table->float('total_money');
            $table->float('paid_money')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('prescription_id', 'FK_bills_1')
                ->references('id')
                ->on('prescriptions')
                ->onDelete('cascade');
            $table->foreign('diagnosis_id', 'FK_bills_2')
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
        Schema::dropIfExists('bills');
    }
}
