<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadfileImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::connection('sqlsrv2')->create('uploadfile_images', function (Blueprint $table) {
        Schema::create('uploadfile_images', function (Blueprint $table) {
            $table->bigIncrements('fileimage_id');
            $table->integer('Datacarfileimage_id')->nullable();
            $table->string('Type_fileimage')->nullable();
            $table->string('Name_fileimage')->nullable();
            $table->string('Size_fileimage')->nullable();
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
        Schema::dropIfExists('uploadfile_images');
    }
}
