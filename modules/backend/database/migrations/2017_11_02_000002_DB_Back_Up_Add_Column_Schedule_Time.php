<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DBBackUpAddColumnScheduleTime extends Migration
{
    public function up()
    {
        Schema::table('site_backup_setting', function (Blueprint $table) {
            if(!Schema::hasColumn('site_backup_setting', 'schedule_time_1'))
            {
                $table->integer('schedule_time_1')->nullable();
            }

            if(!Schema::hasColumn('site_backup_setting', 'schedule_time_2'))
            {
                $table->integer('schedule_time_2')->nullable();
            }
        });
    }

    public function down()
    {
        //
    }
}
