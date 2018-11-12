<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DBBlogPostAddColumnPostReject extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            if(!Schema::hasColumn('rainlab_blog_posts', 'post_reject'))
            {
                $table->tinyInteger('post_reject')->default(0);
            }

            if(!Schema::hasColumn('rainlab_blog_posts', 'owner_read_notify'))
            {
                $table->integer('owner_read_notify')->default(0);
            }
        });
    }

    public function down()
    {
        //
    }
}
