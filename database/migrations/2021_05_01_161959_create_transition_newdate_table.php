<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransitionNewdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transition_newdate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transitions_id');
            $table->timestampTz('new_doc_date')->nullable();
            $table->text('observation')->nullable();
            $table->timestampsTz();

            $table->foreign('transitions_id')->references('id')->on('transitions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transition_newdate');
    }
}
