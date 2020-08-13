<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingCusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_cuses', function (Blueprint $table) {
            $table->bigIncrements('Tracking_id');
            $table->integer('F_DataCus_id')->nullable();
            $table->string('User_Tracking')->nullable();    
            $table->date('Date_Tracking')->nullable();     
            $table->string('Status_Tracking')->nullable();    
            $table->string('Tag_Tracking')->nullable();    
            $table->string('Follow_Tracking')->nullable();    
            $table->string('Note_tracking')->nullable();  
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
        Schema::dropIfExists('tracking_cuses');
    }
}
