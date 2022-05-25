<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandOrPlotsTable extends Migration
{
    public function up()
    {
        Schema::create('land_or_plots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('area');
            $table->longText('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
