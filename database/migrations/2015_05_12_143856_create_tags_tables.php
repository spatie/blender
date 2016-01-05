<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tags', function(Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();
            $table->integer('order_column')->nullable();
            $table->boolean('draft')->default(true);
            $table->boolean('online')->default(true);
            $table->timestamps();
        });

        Schema::create('tag_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->string('url');
            $table->text('description')->nullable();

            $table->unique(['tag_id','locale']);
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });

        Schema::create('taggables', function(Blueprint $table) {
            $table->integer('tag_id')->unsigned();
            $table->integer('taggable_id')->unsigned();
            $table->string('taggable_type');

            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('tag_translations');
        Schema::drop('taggables');
        Schema::drop('tags');
    }
}
