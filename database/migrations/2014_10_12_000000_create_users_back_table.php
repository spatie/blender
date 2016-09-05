<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersBackTable extends Migration
{
    public function up()
    {
        Schema::create('users_back', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60)->nullable();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('locale')->default('nl');
            $table->datetime('last_activity')->nullable();

            $table->string('role')->nullable();
            $table->string('status')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('users_back');
    }
}
