<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBSiteInfoSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_info_setting', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->tinyInteger('status')->default(1);
            $table->string('site_name', 255);
            $table->string('site_url', 255);
            $table->tinyInteger('is_certificate')->default(0);
            $table->string('admin_email', 255);
            $table->tinyInteger('searchable')->default(0);
            $table->text('access_analysis_tag');
            $table->string('license', 255);
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
        Schema::dropIfExists('site_info_setting');
    }
}
