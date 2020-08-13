<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dataCustomer extends Model
{
    protected $table = 'data_customers';
    protected $primaryKey = 'DataCus_id';
    protected $fillable = ['Name_Cus','Phone_Cus','Address_Cus','Province_Cus','Zip_Cus','Career_Cus','Email_Cus',
                          'Origin_Cus','model_Cus','Sale_Cus','DateSale_Cus','CashStatus_Cus','Status_Cus',
                          'DateStatus_Cus','Type_Cus','DateType_Cus',
                          'RegistCar_Cus','BrandCar_Cus','VersionCar_Cus','ColorCar_Cus','GearCar_Cus',
                          'YearCar_Cus','PriceCar_Cus'];

    public function datacar()
    {
        return $this->hasMany(data_car::class);
    }

    public function tracking()
    {
        return $this->hasMany(tracking_cus::class);
    }
}
