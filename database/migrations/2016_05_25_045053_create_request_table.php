<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("requests", function (Blueprint $table) {
            $table->integer("from_user_id")->unsigned();
            $table->integer("to_user_id")->unsigned();
            $table->timestamps();

            $table->foreign("from_user_id")->references("id")->on("users");
            $table->foreign("to_user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("requests", function (Blueprint $table) {
            $table->dropForeign("requests_from_user_id_foreign");
            $table->dropForeign("requests_to_user_id_foreign");
        });
        Schema::drop("requests");
    }
}
