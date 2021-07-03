<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccurrenceDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occurrence_docs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('occurrence_id');
            $table->unsignedBigInteger('transition_id');
            $table->bigInteger('sales_id')->nullable();
            $table->bigInteger('invoices_id')->nullable();
            $table->bigInteger('workorders_id')->nullable();
            $table->timestampsTz();

            $table->foreign('occurrence_id')->references('id')->on('occurrences');
            $table->foreign('transition_id')->references('id')->on('transitions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('occurrence_docs');
    }
}
