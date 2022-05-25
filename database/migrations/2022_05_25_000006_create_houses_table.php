<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('property_title');
            $table->string('slug')->nullable();
            $table->decimal('price', 15, 2);
            $table->string('area')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->decimal('bathrooms', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->longText('description');
            $table->string('approved')->nullable();
            $table->string('house_address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
