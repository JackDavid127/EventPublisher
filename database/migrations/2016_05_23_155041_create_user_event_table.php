<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_event', function (Blueprint $table) {
            $table->integer("user_id")->unsigned();
            $table->integer("event_id")->unsigned();
            $table->string("message",64);

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("event_id")->references("event_id")->on("events")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_event', function (Blueprint $table) {
            $table->dropForeign("user_event_user_id_foreign");
            $table->dropForeign("user_event_event_id_foreign");
        });
        Schema::drop('user_event');
    }
}
