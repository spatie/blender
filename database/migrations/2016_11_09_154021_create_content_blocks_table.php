<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentBlocksTable extends Migration
{
    public function up()
    {
        Schema::create('content_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model_type');
            $table->integer('model_id');
            $table->string('collection_name')->nullable();
            $table->string('type')->nullable();
            $table->json('name')->nullable();
            $table->json('text')->nullable();
            $table->json('properties')->nullable();
            $table->integer('order_column')->nullable();
            $table->boolean('draft')->default(true);
            $table->boolean('online')->default(true);
            $table->timestamps();
        });
    }
}
