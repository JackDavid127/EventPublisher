<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->integer("user1_id")->unsigned();
            $table->integer("user2_id")->unsigned();

            $table->foreign("user1_id")->references("id")->on("users");
            $table->foreign("user2_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('friends', function (Blueprint $table) {
            $table->dropForeign("friends_user1_id_foreign");
            $table->dropForeign("friends_user2_id_foreign");
        });
        Schema::drop('friends');
    }
}
