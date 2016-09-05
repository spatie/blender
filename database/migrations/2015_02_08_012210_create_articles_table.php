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
            $table->text('seo_values');
            $table->boolean('draft')->default(true);
            $table->boolean('online')->default(true);
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('technical_name')->nullable();
            $table->integer('order_column')->nullable();
            $table->timestamps();
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('articles');
        });
    }

    public function down()
    {
        Schema::drop('articles');
    }
}
