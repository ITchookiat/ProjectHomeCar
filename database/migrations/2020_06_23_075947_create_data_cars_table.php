<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::connection('sqlsrv2')->create('data_cars', function (Blueprint $table) {
        Schema::create('data_cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('F_DataCus_id')->nullable();
            $table->string('Car_type')->nullable();
            $table->string('create_date')->nullable();
            $table->string('Date_Status')->nullable();
            $table->string('Date_Auction')->nullable();     //วันที่สถานะ ส่งประมูล
            $table->string('Date_Soldout')->nullable();
            $table->string('Date_Repair')->nullable();
            $table->string('Date_Sale')->nullable();
            $table->string('Date_Color')->nullable();
            $table->string('Date_Wait')->nullable();
            $table->string('Brand_Car')->nullable();
            $table->string('Version_Car')->nullable();
            $table->string('Model_Car')->nullable();
            $table->string('Color_Car')->nullable();
            $table->string('Size_Car')->nullable();
            $table->string('Chassis_car')->nullable(); //เลขตัวถัง
            $table->string('Job_Number')->nullable();
            $table->string('Number_Miles')->nullable();
            $table->string('Gearcar')->nullable();
            $table->string('Year_Product')->nullable();
            $table->string('Number_Regist')->nullable();
            $table->string('Name_Sale')->nullable();
            $table->string('Net_Price')->nullable();        //ราคาขาย
            $table->string('Repair_Price')->nullable();
            $table->string('Fisrt_Price')->nullable();
            $table->string('Color_Price')->nullable();
            $table->string('Origin_Car')->nullable();
            $table->string('Offer_Price')->nullable();
            $table->string('Add_Price')->nullable();
            $table->string('Date_Soldout_plus')->nullable();
            $table->string('Date_Withdraw')->nullable();
            $table->string('Net_Priceplus')->nullable();    //ราคาขายจริง
            $table->string('Amount_Price')->nullable();
            $table->string('Name_Saleplus')->nullable();
            $table->string('Type_Sale')->nullable();
            $table->string('Name_Agent')->nullable();
            $table->string('Name_Buyer')->nullable();
            $table->string('Accounting_Cost')->nullable();
            //ข้อมูลยืม
            $table->string('Date_Borrowcar')->nullable();
            $table->string('Date_Returncar')->nullable();
            $table->string('Name_Borrow')->nullable();
            $table->string('Note_Borrow')->nullable();
            $table->string('BorrowStatus')->nullable();
            //ข้อมูลหัก vat
            $table->string('Down_Price')->nullable();
            $table->string('Transfer_Price')->nullable();
            $table->string('Subdown_Price')->nullable();
            $table->string('Insurance_Price')->nullable();
            $table->string('Topcar_Price')->nullable();
            //ข้อมูลลูกค้า Research Cus
            $table->string('BookStatus_Car')->nullable();      //สถานะจอง
            $table->string('DateStatus_Car')->nullable();      //วันที่สถานะจอง
            //ข้อมูลประมูลรถ
            $table->string('Open_auction')->nullable();        //เปิดประมูล
            $table->string('Close_auction')->nullable();       //ปิดประมูล
            $table->string('Expected_Sell')->nullable();       //ราคาคาดว่าจะขาย

            $table->string('Expected_Repair')->nullable();       //ราคาประเมิณซ่อม
            $table->string('Expected_Color')->nullable();       //ราคาประเมิณทำสี
            
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
        Schema::dropIfExists('data_cars');
    }
}
