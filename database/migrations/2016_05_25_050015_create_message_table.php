<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments("mssg_id");
            $table->integer("from_user_id")->unsigned();
            $table->integer("to_user_id")->unsigned();
            $table->string("text", 120);
            $table->boolean("read");
            $table->timestamps();
            $table->softDeletes();

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
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign("messages_from_user_id_foreign");
            $table->dropForeign("messages_to_user_id_foreign");
        });
        Schema::drop('messages');
    }
}
