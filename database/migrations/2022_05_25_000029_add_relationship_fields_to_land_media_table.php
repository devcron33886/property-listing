<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLandMediaTable extends Migration
{
    public function up()
    {
        Schema::table('land_media', function (Blueprint $table) {
            $table->unsignedBigInteger('land_id')->nullable();
            $table->foreign('land_id', 'land_fk_6664850')->references('id')->on('land_or_plots');
        });
    }
}
