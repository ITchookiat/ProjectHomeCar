<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('sqlsrv2')->create('data_customers', function (Blueprint $table) {
        // Schema::create('data_customers', function (Blueprint $table) {
            $table->bigIncrements('DataCus_id');
            $table->string('Name_Cus')->nullable();     
            $table->string('Phone_Cus')->nullable();    
            $table->string('Address_Cus')->nullable();    
            $table->string('Province_Cus')->nullable();  
            $table->string('Zip_Cus')->nullable();    
            $table->string('Career_Cus')->nullable();
            $table->string('Email_Cus')->nullable();     
            $table->string('Origin_Cus')->nullable();   
            $table->string('model_Cus')->nullable();     
            $table->string('Sale_Cus')->nullable();   
            $table->date('DateSale_Cus')->nullable();   
            $table->string('Status_Cus')->nullable();   
            $table->date('DateStatus_Cus')->nullable();   
            $table->string('Type_Cus')->nullable();   
            $table->date('DateType_Cus')->nullable();   
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
        Schema::dropIfExists('data_customers');
    }
}
