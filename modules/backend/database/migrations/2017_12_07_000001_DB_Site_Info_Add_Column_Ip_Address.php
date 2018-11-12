<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DBSiteInfoAddColumnIpAddress extends Migration
{
    public function up()
    {
        Schema::table('site_info_setting', function (Blueprint $table) {
            if(!Schema::hasColumn('site_info_setting', 'is_limit_ip'))
            {
                $table->tinyInteger('is_limit_ip')->after('site_url')->default(0);
            }

            if(!Schema::hasColumn('site_info_setting', 'ip_address'))
            {
                $table->string('ip_address', 255)->after('is_limit_ip')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('site_info_setting', function ($table) {
            $table->dropColumn('is_limit_ip');
            $table->dropColumn('ip_address');
        });
    }
}
