<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFragmentsTable extends Migration
{
    public function up()
    {
        Schema::create('fragments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->text('text');
            $table->string('description')->nullable();
            $table->boolean('contains_html')->default(false);
            $table->boolean('hidden')->default(false);
            $table->boolean('draft')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('fragments');
    }
}
