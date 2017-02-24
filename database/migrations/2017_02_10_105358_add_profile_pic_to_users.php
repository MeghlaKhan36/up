<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfilePicToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('profile_picture')->default('images/user/default.png');
            $table->dropColumn('profile_picture_path');
            $table->string('account_status')->default('public');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table)
        {
            Schema::dropIfExists('first_name');
            Schema::dropIfExists('last_name');
            Schema::dropIfExists('profile_picture');
            Schema::dropIfExists('account_status');
        });
    }
}
