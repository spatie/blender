<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormResponseTable extends Migration
{
    public function up()
    {
        Schema::create('form_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('email', 100);
            $table->string('telephone', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('postal', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->text('remarks', 64)->nullable();
            $table->string('referer')->nullable();
            $table->timestamps();
        });
    }
}
