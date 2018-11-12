<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBInsertAuthUserIntoSiteInfoSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_info_setting', function ($table) {
            $table->string('username_certificate')->after('is_certificate')->nullable();
            $table->string('password_certificate')->after('username_certificate')->nullable();
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
            $table->dropColumn('username_certificate');
            $table->dropColumn('password_certificate');
        });
    }
}
