<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersFrontTable extends Migration
{
    public function up()
    {
        Schema::create('users_front', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60)->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->string('postal')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('telephone')->nullable();
            $table->string('locale')->default('nl');
            $table->datetime('last_activity')->nullable();
            $table->string('role')->nullable();
            $table->string('status')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }
}
