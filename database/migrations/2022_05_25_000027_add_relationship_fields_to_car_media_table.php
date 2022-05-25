<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCarMediaTable extends Migration
{
    public function up()
    {
        Schema::table('car_media', function (Blueprint $table) {
            $table->unsignedBigInteger('car_id')->nullable();
            $table->foreign('car_id', 'car_fk_6664741')->references('id')->on('cars');
        });
    }
}
