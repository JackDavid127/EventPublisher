<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('event_id');
            $table->integer('event_user_id')->unsigned();
            $table->string("event_title",128);
            $table->string("event_content",1024);
            $table->string("event_limit",1024);
            $table->integer("event_total")->unsigned();
            $table->datetime("event_start");
            $table->datetime("event_end");
            $table->string("event_place",64);
            $table->datetime("event_opentill");

            $table->foreign("event_user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("events", function (Blueprint $table) {
            $table->dropForeign("events_event_user_id_foreign");
        });
        Schema::drop('events');
    }
}
