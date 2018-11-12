<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DbSiteBackupSettingAddColumnUserId extends Migration
{
    public function up()
    {
        Schema::table('site_backup_setting', function (Blueprint $table) {
            if(!Schema::hasColumn('site_backup_setting', 'user_created_id'))
            {
                $table->integer('user_created_id');
            }

            if(!Schema::hasColumn('site_backup_setting', 'user_updated_id'))
            {
                $table->integer('user_updated_id');
            }
        });
    }

    public function down()
    {
        //
    }
}
