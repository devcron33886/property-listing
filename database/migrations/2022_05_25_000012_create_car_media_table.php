<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarMediaTable extends Migration
{
    public function up()
    {
        Schema::create('car_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('car_video')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
