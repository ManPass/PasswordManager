<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD:database/migrations/2014_10_12_000000_create_users_table.php
        Schema::create('Loh', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
=======
        Schema::create('users', function (Blueprint $table) {
            $table->increments("id");
            //$table->binary("URLID");
            //$table->binary("RoleID");
            $table->string("remember_token", 255)->unique()->nullable()->default(null);
            $table->string("login");
            $table->string("password");
>>>>>>> 2411b5a80bfc78945cac7a278ad47e464906294b:database/migrations/2021_06_11_103348_create_users_table.php
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
        Schema::dropIfExists('Users');
    }
}
