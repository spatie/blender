<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
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
            $table->timestamps();
        });
    }
}
