<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTables extends Migration
{
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->json('name')->nullable();
            $table->json('slug')->nullable();
            $table->string('type')->nullable();
            $table->integer('order_column')->nullable();
            $table->boolean('draft')->default(true);
            $table->boolean('online')->default(true);
            $table->timestamps();

            $table->index('type');
        });

        Schema::create('taggables', function (Blueprint $table) {
            $table->integer('tag_id')->unsigned();
            $table->integer('taggable_id')->unsigned();
            $table->string('taggable_type');

            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
