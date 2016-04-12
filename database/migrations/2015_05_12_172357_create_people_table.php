<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    public function up()
    {
        Schema::create('people', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url');
            $table->text('text');
            $table->integer('order_column')->nullable();
            $table->boolean('draft')->default(1);
            $table->boolean('online')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('people');
    }
}
