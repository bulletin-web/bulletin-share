<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBBackendAddColumnCopyrightIntoInfoSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_info_setting', function ($table) {
            if (!Schema::hasColumn('site_info_setting', 'copyright')) {
                $table->string('copyright')
                    ->after('site_url')
                    ->nullable()
                    ->default(null);
            }
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
            $table->dropColumn('copyright');
        });
    }
}
