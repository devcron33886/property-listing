<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6665109')->references('id')->on('users');
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->foreign('plan_id', 'plan_fk_6665110')->references('id')->on('plans');
        });
    }
}
