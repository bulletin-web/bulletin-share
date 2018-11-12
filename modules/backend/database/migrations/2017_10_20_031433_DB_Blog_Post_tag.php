<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBBlogPostTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rainlab_blog_posts_tags', function ($table) {
            $table->engine = 'InnoDB';
            $table->integer('post_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->primary(['post_id', 'tag_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rainlab_blog_posts_tags');
    }
}
