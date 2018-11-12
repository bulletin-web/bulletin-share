<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DBBlogPostAlterColumnCategoryId extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            if(Schema::hasColumn('rainlab_blog_posts', 'category_id'))
            {
                $table->integer('category_id')->nullable()->change();
            }
        });
    }

    public function down()
    {
        //
    }
}
