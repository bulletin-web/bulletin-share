<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DBBlogPostAddColumnCategoryId extends Migration
{
    public function up()
    {
        Schema::create('rainlab_blog_posts', function (Blueprint $table) {
            if(!Schema::hasColumn('rainlab_blog_posts', 'category_id'))
            {
                $table->engine = 'InnoBD';
                $table->integer('category_id');
            }
        });
    }

    public function down()
    {
        //
    }
}
