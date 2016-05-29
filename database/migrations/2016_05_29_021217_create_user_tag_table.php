<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tag', function (Blueprint $table) {
            $table->integer("user_id")->unsigned();
            $table->string("tag_name", 64);

            $table->foreign("user_id")->references("id")->on("users");
            $table->primary(['user_id', 'tag_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_tag', function (Blueprint $table) {
            $table->dropForeign('user_tag_user_id_foreign');
        });
        Schema::drop('user_tag');
    }
}
