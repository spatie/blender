<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsItemsTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('news_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('size');
            $table->datetime('publish_date');
            $table->boolean('draft')->default(true);
            $table->boolean('online')->default(true);
            $table->timestamps();
        });

        Schema::create('news_item_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('text');
            $table->string('url');
            $table->string('locale')->index();

            $table->integer('news_item_id')->unsigned();
            $table->foreign('news_item_id')->references('id')->on('news_items')->onDelete('cascade');
            $table->unique(['news_item_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('news_item_translations');
        Schema::drop('news_items');
    }
}
