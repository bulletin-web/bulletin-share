<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DBBlogPostAlterColumnReviewerComment extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            if(Schema::hasColumn('rainlab_blog_posts', 'reviewer_comment'))
            {
                $table->text('reviewer_comment')->nullable()->change();
            }
        });
    }

    public function down()
    {
        //
    }
}
