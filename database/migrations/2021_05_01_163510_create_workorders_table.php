<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workorders', function (Blueprint $table) {
            $table->id();
            $table->text('open_description')->nullable();
            $table->bigInteger('worktype_id');
            $table->text('executed_work')->nullable();
            $table->boolean('warranty');
            $table->bigInteger('operator_id');
            $table->bigInteger('technical_id')->nullable();
            $table->bigInteger('faultresponsibility_id')->nullable();
            $table->bigInteger('contacttype_id')->nullable();
            $table->bigInteger('defect_id')->nullable();
            $table->integer('priority')->nullable();
            $table->timestampTz('emission')->nullable();
            $table->bigInteger('avati_id')->nullable();
            $table->boolean('completed')->nullable();
            $table->timestampTz('due_date')->nullable();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workorders');
    }
}
