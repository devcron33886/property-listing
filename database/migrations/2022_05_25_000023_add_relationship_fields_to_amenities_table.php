<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAmenitiesTable extends Migration
{
    public function up()
    {
        Schema::table('amenities', function (Blueprint $table) {
            $table->unsignedBigInteger('house_id')->nullable();
            $table->foreign('house_id', 'house_fk_6664396')->references('id')->on('houses');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6665168')->references('id')->on('teams');
        });
    }
}
