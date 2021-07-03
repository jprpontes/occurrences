<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('occurrence_id');
            $table->unsignedBigInteger('step_id');
            $table->boolean('isactive');
            $table->boolean('wasapproved');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestampTz('close_date')->nullable();
            $table->timestampTz('doc_due_date')->nullable();
            $table->timestampsTz();

            $table->foreign('occurrence_id')->references('id')->on('occurrences');
            $table->foreign('step_id')->references('id')->on('steps');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transitions');
    }
}
