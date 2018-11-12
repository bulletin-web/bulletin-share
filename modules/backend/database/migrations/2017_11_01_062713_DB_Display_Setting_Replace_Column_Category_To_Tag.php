<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBDisplaySettingReplaceColumnCategoryToTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_display_setting', function ($table) {
            if (Schema::hasColumn('site_display_setting', 'default_category')){
                $table->dropColumn('default_category');
            }
            $table->integer('default_tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_display_setting', function ($table) {
            $table->dropColumn('default_tag');
        });
    }
}
