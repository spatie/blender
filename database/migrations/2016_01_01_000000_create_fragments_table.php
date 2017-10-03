<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragmentsTable extends Migration
{
    public function up()
    {
        Schema::create('fragments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group');
            $table->string('key');
            $table->json('text');
            $table->string('description')->nullable();
            $table->boolean('html')->default(false);
            $table->boolean('image')->default(false);
            $table->timestamps();

            $table->index('group');
        });
    }
}
