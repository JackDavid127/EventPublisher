<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("event_tag", function (Blueprint $table) {
            $table->integer("event_id")->unsigned();
            $table->string("tag_name", 64);

            $table->foreign("event_id")->references("event_id")->on("events")->onDelete("cascade");
            $table->primary(['event_id', 'tag_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("event_tag", function (Blueprint $table) {
            $table->dropForeign("event_tag_event_id_foreign");
        });
        Schema::drop("event_tag");
    }
}
