<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DbBackendUsersAddMoreColumn extends Migration
{
    public function up()
    {
        Schema::table('backend_users', function (Blueprint $table) {
            if(!Schema::hasColumn('backend_users', 'gender'))
            {
                $table->string('gender')->nullable();
            }

            if(!Schema::hasColumn('backend_users', 'position'))
            {
                $table->string('position')->nullable();
            }

            if(!Schema::hasColumn('backend_users', 'birthday'))
            {
                $table->date('birthday')->nullable();
            }

            if(!Schema::hasColumn('backend_users', 'hobby'))
            {
                $table->text('hobby')->nullable();
            }
        });
    }

    public function down()
    {

    }
}
