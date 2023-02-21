<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->string('bed_code')->unique();
            $table->string('name');
            $table->unsignedBigInteger('bed_type_id');
            $table->float('charge');
            $table->float('status');
            $table->timestamps();
            $table->softDeletes();

            // declare foreign key
            $table->foreign('bed_type_id', 'FK_beds_1')
                ->references('id')
                ->on('bed_types')
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
        Schema::dropIfExists('beds');
    }
}
