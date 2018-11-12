<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DBBlogPostAddColumnReviewerRead extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            if(!Schema::hasColumn('rainlab_blog_posts', 'reviewer_read'))
            {
                $table->tinyInteger('reviewer_read')->default(0);
            }

            if(!Schema::hasColumn('rainlab_blog_posts', 'reviewer_comment'))
            {
                $table->integer('reviewer_comment')->nullable();
            }
        });
    }

    public function down()
    {
        //
    }
}
