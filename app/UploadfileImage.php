<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadfileImage extends Model
{
  protected $connection = 'sqlsrv2';
  protected $table = 'uploadfile_images';
  protected $primaryKey = 'Datacarfileimage_id';
  protected $fillable = ['Datacarfileimage_id','Type_fileimage','Name_fileimage','Size_fileimage'];

  public function Buyeruploadfileimages()
  {
    return $this->belongsTo(Buyer::class,'Buyerfileimage_id');
  }
}
