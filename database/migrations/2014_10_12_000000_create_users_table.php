<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_id', 60)->unique();
            $table->string('facebook_id', 30)->unique();
            $table->string('firstname', 20);
            $table->string('lastname', 30);
            $table->string('mobile', 15)->unique();
            $table->string('email', 250)->unique();
            $table->string('password');
            $table->integer('connected_to');
            $table->tinyInteger('type');
            $table->tinyInteger('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
