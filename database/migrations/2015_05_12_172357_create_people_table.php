<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->json('text')->nullable();
            $table->integer('order_column')->nullable();
            $table->boolean('draft')->default(1);
            $table->boolean('online')->default(1);
            $table->timestamps();
        });
    }
}
