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
            $table->index('group');
            $table->string('key');
            $table->json('text');
            $table->string('description')->nullable();
            $table->boolean('contains_html')->default(false);
            $table->boolean('contains_image')->default(false);
            $table->boolean('hidden')->default(false);
            $table->boolean('draft')->default(true);
            $table->timestamps();
        });
    }
}
