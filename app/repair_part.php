<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class repair_part extends Model
{
    protected $table = 'repair_parts';
    protected $primaryKey = 'Repair_id';
    protected $fillable = ['Datacar_id','Repair_date','Repair_list','Repair_amount','Repair_price','Repair_detail','Repair_useradd'];

    public function datacar()
    {
        return $this->hasMany(data_car::class);
    }

}
