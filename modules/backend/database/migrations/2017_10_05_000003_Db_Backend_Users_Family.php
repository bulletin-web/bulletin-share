<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DbBackendUsersFamily extends Migration
{
    public function up()
    {
        Schema::create('backend_users_family', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('user_id')->unsigned();
            $table->integer('member_family_id')->unsigned();
            $table->primary(['user_id', 'member_family_id'], 'member_family');
        });
    }

    public function down()
    {
        Schema::dropIfExists('backend_users_family');
    }
}
