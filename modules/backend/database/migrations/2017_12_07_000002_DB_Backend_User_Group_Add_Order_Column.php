<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DBBackendUserGroupAddOrderColumn extends Migration
{
    public function up()
    {
        Schema::table('backend_user_groups', function (Blueprint $table) {
            if(!Schema::hasColumn('backend_user_groups', 'display_order'))
            {
                $table->integer('display_order');
            }
        });
    }

    public function down()
    {
        //
    }
}
