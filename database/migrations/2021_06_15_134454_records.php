<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Records extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        {
            Schema::create('records', function (Blueprint $table) {
                $table->increments("id");
                $table->string("source");
                $table->string("password", 255);
                $table->string("login")->nullable();
                $table->string("url")->nullable();
                $table->text("comment")->nullable();
                $table->string("tag")->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
