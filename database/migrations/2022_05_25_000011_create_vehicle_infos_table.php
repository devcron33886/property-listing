<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleInfosTable extends Migration
{
    public function up()
    {
        Schema::create('vehicle_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fuel');
            $table->string('steeling');
            $table->boolean('air_bag')->default(0)->nullable();
            $table->string('transmission');
            $table->boolean('audio_input')->default(0)->nullable();
            $table->boolean('bluetooth')->default(0)->nullable();
            $table->boolean('heated_seats')->default(0)->nullable();
            $table->boolean('fm_radio')->default(0)->nullable();
            $table->boolean('usb_input')->default(0)->nullable();
            $table->boolean('gps_navigation')->default(0)->nullable();
            $table->boolean('sunroof')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
