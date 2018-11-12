<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DBBlogPostAddMoreColumn extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            if(!Schema::hasColumn('rainlab_blog_posts', 'status'))
            {
                $table->tinyInteger('status')->default(1);
            }

            if(!Schema::hasColumn('rainlab_blog_posts', 'reviewer_id'))
            {
                $table->integer('reviewer_id')->nullable();
            }

            if(!Schema::hasColumn('rainlab_blog_posts', 'publish_type'))
            {
                $table->tinyInteger('publish_type')->nullable();
            }

            if(!Schema::hasColumn('rainlab_blog_posts', 'is_slide_show'))
            {
                $table->tinyInteger('is_slide_show')->default(0);
            }

            if(!Schema::hasColumn('rainlab_blog_posts', 'has_comment'))
            {
                $table->tinyInteger('has_comment');
            }
        });
    }

    public function down()
    {
        //
    }
}
