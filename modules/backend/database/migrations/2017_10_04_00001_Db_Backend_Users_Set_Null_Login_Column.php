<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DbBackendUsersSetNullLoginColumn extends Migration
{
    public function up()
    {
        Schema::table('backend_users', function (Blueprint $table) {
            if(Schema::hasColumn('backend_users', 'login'))
            {
                $table->string('login')->nullable()->change();
            }
        });
    }

    public function down()
    {

    }
}
