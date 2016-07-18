<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTables extends Migration
{
	public function up()
	{
        Schema::create('tags', function(Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('url');
            $table->string('type')->nullable();
            $table->integer('order_column')->nullable();
            $table->boolean('draft')->default(true);
            $table->boolean('online')->default(true);
            $table->timestamps();

            $table->index('type');
        });

        Schema::create('taggables', function(Blueprint $table) {
            $table->integer('tag_id')->unsigned();
            $table->integer('taggable_id')->unsigned();
            $table->string('taggable_type');

            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
	}

	public function down()
	{
        Schema::drop('taggables');
        Schema::drop('tags');
    }
}
