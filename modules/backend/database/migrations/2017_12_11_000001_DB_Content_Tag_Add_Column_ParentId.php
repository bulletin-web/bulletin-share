<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DBContentTagAddColumnParentId extends Migration
{
    public function up()
    {
        Schema::table('content_tag', function (Blueprint $table) {
            if(!Schema::hasColumn('content_tag', 'parent_tag_id'))
            {
                $table->integer('parent_tag_id')->after('description')->default(0);
            }
        });
    }

    public function down()
    {
        //
    }
}
