<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dataCustomer extends Model
{
    protected $table = 'data_customers';
    protected $primaryKey = 'DataCus_id';
    protected $fillable = ['Name_Cus','Phone_Cus','Address_Cus','Province_Cus','Zip_Cus','Career_Cus','Email_Cus',
                          'Origin_Cus','model_Cus','Sale_Cus','DateSale_Cus','Status_Cus','DateStatus_Cus','Type_Cus',
                          'DateType_Cus'];
}
