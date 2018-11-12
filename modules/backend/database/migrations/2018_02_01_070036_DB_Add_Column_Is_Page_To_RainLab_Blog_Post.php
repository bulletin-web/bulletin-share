<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBAddColumnIsPageToRainLabBlogPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rainlab_blog_posts', function ($table) {
            if (!Schema::hasColumn('rainlab_blog_posts', 'is_page')) {
                $table->tinyInteger('is_page')
//                ->after('published')
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
        //
    }
}
