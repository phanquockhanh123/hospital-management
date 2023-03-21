<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('document_file');
            $table->string('filename');
            $table->integer('document_type');
            $table->string('note');
            $table->timestamps();
            $table->softDeletes();

            // declare foreign key
            $table->foreign('doctor_id', 'FK_documents_1')
                ->references('id')
                ->on('doctors')
                ->onDelete('cascade');


            // declare foreign key
            $table->foreign('patient_id', 'FK_documents_2')
                ->references('id')
                ->on('patients')
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
        Schema::dropIfExists('documents');
    }
}
