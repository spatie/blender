<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('text');
            $table->text('url');
            $table->boolean('draft')->default(true);
            $table->boolean('online')->default(true);
            $table->string('technical_name')->nullable();
            $table->integer('order_column')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('articles');
    }
}
