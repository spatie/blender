<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url');
            $table->integer('order_column')->nullable();
            $table->boolean('draft')->default(1);
            $table->boolean('online')->default(1);
            $table->timestamps();
        });

        Schema::create('person_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->string('locale')->index();

            $table->integer('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');

            $table->unique(['person_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('person_translations');
        Schema::drop('people');
    }
}
