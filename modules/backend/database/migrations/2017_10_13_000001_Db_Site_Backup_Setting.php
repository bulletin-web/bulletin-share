<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DbSiteBackupSetting extends Migration
{
    public function up()
    {
        Schema::create('site_backup_setting', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('storage_path');
            $table->tinyInteger('schedule_option');
            $table->integer('time')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_backup_setting');
    }
}
