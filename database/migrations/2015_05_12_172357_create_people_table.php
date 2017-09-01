<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->json('text')->nullable();
            $table->integer('order_column')->nullable();
            $table->boolean('draft')->default(1);
            $table->boolean('online')->default(1);
            $table->timestamps();
        });
    }
}
