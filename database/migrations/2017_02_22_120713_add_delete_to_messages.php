<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteToMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function($table)
        {
            $table->integer('sender_deleted');
            $table->integer('receiver_deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function($table)
        {
            Schema::dropIfExists('sender_deleted');
            Schema::dropIfExists('receiver_deleted');
        });
    }
}
