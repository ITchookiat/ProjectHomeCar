<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tracking_cus extends Model
{
    protected $table = 'tracking_cuses';
    protected $primaryKey = 'Tracking_id';
    protected $fillable = ['F_DataCus_id','User_Tracking','Date_Tracking','Status_Tracking','Tag_Tracking',
                           'Follow_Tracking','Note_tracking'];

    public function dataCus()
    {
        return $this->belongsTo(dataCustomer::class,'F_DataCus_id');
    }                       
}
