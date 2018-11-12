<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DBBlogPostAddColumnCountView extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            if(!Schema::hasColumn('rainlab_blog_posts', 'count_view'))
            {
                $table->integer('count_view')->default(0);
            }
        });
    }

    public function down()
    {
        //
    }
}
