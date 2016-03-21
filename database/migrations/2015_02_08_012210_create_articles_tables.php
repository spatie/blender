<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTables extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('draft')->default(true);
            $table->boolean('online')->default(true);
            $table->string('technical_name')->nullable();
            $table->integer('order_column')->nullable();
            $table->timestamps();
        });

        Schema::create('article_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->string('locale')->index();
            $table->string('url');
            $table->string('name');
            $table->text('text');
            $table->unique(['article_id','locale']);
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('article_translations');
        Schema::drop('articles');
    }
}
