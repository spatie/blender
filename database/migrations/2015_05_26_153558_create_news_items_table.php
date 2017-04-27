<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_items', function (Blueprint $table) {
            $table->increments('id');
            $table->json('name')->nullable();
            $table->json('text')->nullable();
            $table->json('slug')->nullable();
            $table->json('meta_values')->nullable();
            $table->datetime('publish_date');
            $table->boolean('draft')->default(true);
            $table->boolean('online')->default(true);
            $table->timestamps();
        });
    }
}
