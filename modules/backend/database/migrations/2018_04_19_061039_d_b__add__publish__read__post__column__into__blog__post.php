<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBAddPublishReadPostColumnIntoBlogPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rainlab_blog_posts', function ($table) {
            if (!Schema::hasColumn('rainlab_blog_posts', 'publish_read_post'))
            {
                $table->integer('publish_read_post')
                    ->after('approved')
                    ->nullable()
                    ->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rainlab_blog_posts', function ($table) {
            $table->dropColumn('publish_read_post');
        });
    }
}
