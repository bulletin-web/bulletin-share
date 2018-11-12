<?php

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class DBBlogPostAddColumnContentJson extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function (Blueprint $table) {
            if(!Schema::hasColumn('rainlab_blog_posts', 'content_json'))
            {
                $table->longText('content_json')->nullable();
            }
        });
    }

    public function down()
    {
        //
    }
}
