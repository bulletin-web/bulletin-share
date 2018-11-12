<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBInsertAcceptSocialIntoSiteInfoSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_info_setting', function ($table) {
            $table->tinyInteger('accept_facebook')->after('searchable')->nullable();
            $table->tinyInteger('accept_twitter')->after('accept_facebook')->nullable();
            $table->integer('user_create_id')->after('license');
            $table->integer('user_update_id')->after('user_create_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_info_setting', function ($table) {
            $table->dropColumn('accept_facebook');
            $table->dropColumn('accept_twitter');
            $table->dropColumn('user_create_id');
            $table->dropColumn('user_update_id');
        });
    }
}
