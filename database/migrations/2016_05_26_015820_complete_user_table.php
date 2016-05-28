<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompleteUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('truename', 64);
            $table->string('phone', 64);
            $table->string('hobby', 64);
            $table->string('intro', 128);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('truename');
            $table->dropColumn('phone');
            $table->dropColumn('hobby');
            $table->dropColumn('intro');
        });
    }
}
