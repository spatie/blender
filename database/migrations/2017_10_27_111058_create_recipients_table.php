<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientsTable extends Migration
{
    public function up()
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('form')->nullable();
            $table->string('email')->nullable();
            $table->boolean('draft')->default(true);
            $table->timestamps();
        });
    }
}
