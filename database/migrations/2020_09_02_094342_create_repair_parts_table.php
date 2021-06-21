<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_parts', function (Blueprint $table) {
            $table->bigIncrements('Repair_id');
            $table->integer('Datacar_id')->nullable();
            $table->string('Repair_date')->nullable();
            $table->string('Repair_list')->nullable();
            $table->string('Repair_amount')->nullable();
            $table->string('Repair_unit')->nullable();
            $table->string('Repair_price')->nullable();
            $table->string('Repair_detail')->nullable();
            $table->string('Repair_useradd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_parts');
    }
}
