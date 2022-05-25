<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHouseGalleriesTable extends Migration
{
    public function up()
    {
        Schema::table('house_galleries', function (Blueprint $table) {
            $table->unsignedBigInteger('house_id')->nullable();
            $table->foreign('house_id', 'house_fk_6664511')->references('id')->on('houses');
        });
    }
}
