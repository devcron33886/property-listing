<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenitiesTable extends Migration
{
    public function up()
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('parking')->default(0)->nullable();
            $table->integer('garage')->nullable();
            $table->string('building_age')->nullable();
            $table->boolean('air_condition')->default(0)->nullable();
            $table->boolean('bedding')->default(0)->nullable();
            $table->boolean('heating')->default(0)->nullable();
            $table->boolean('internet')->default(0)->nullable();
            $table->boolean('microwave')->default(0)->nullable();
            $table->boolean('smoking_allow')->default(0)->nullable();
            $table->boolean('terrace')->default(0)->nullable();
            $table->boolean('balcony')->default(0)->nullable();
            $table->boolean('wi_fi')->default(0)->nullable();
            $table->boolean('beach')->default(0)->nullable();
            $table->string('property_video')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
