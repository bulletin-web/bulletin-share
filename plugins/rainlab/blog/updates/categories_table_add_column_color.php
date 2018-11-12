<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CategoriesTableAddColumnColor extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_categories', function (Blueprint $table) {
            if(!Schema::hasColumn('rainlab_blog_categories', 'color'))
            {
                $table->string('color');
            }
        });
    }

    public function down()
    {
        //
    }
}
