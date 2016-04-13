<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsItemsTable extends Migration
{
    public function up()
    {
        Schema::create('news_items', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('text');
            $table->text('url');
            $table->datetime('publish_date');
            $table->boolean('draft')->default(true);
            $table->boolean('online')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('news_items');
    }
}
