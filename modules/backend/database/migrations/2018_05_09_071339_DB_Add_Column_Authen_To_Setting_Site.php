<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBAddColumnAuthenToSettingSite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_info_setting', function ($table) {
            if (!Schema::hasColumn('site_info_setting', 'is_basicauth')) {
                $table->integer('is_basicauth')
                    ->after('is_certificate')
                    ->nullable()
                    ->default(0);
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
            $table->dropColumn('is_basicauth');
        });
    }
}
