<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RoleRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_records', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("user_role_id")->unsigned();
            $table->integer("records_id")->unsigned();
            
            $table->foreign("user_role_id")->references("id")->on("user_role")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("records_id")->references("id")->on("records")->onUpdate("cascade")->onDelete("cascade");

        });
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
