<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedirectsTable extends Migration
{
    public function up()
    {
        Schema::create('redirects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('old_url')->nullable();
            $table->string('new_url')->nullable();
            $table->boolean('draft')->default(true);
            $table->boolean('online')->default(true);
            $table->integer('order_column')->nullable();
            $table->timestamps();
        });
    }
}
