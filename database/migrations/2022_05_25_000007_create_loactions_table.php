<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoactionsTable extends Migration
{
    public function up()
    {
        Schema::create('loactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('state');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
