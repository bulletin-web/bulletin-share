<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBSiteDisplaySetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_display_setting', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('logo');
            $table->string('menu_color');
            $table->tinyInteger('display_special_page')->default(0);
            $table->string('url_special_page')->nullable();
            $table->integer('default_category')->nullable();
            $table->tinyInteger('slide_enable')->default(0);
            $table->integer('post_per_page')->nullable();
            $table->integer('user_created_id');
            $table->integer('user_updated_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_display_setting');
    }
}
