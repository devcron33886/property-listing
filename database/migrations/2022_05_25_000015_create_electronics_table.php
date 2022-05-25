<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectronicsTable extends Migration
{
    public function up()
    {
        Schema::create('electronics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->decimal('price', 15, 2);
            $table->longText('description');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
