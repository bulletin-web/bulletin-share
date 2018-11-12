<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBAddListParentListChildrenTagColumnToPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rainlab_blog_posts', function ($table) {
            if(!Schema::hasColumn('rainlab_blog_posts', 'parent_tag_list'))
            {
                $table->text('parent_tag_list')
//                    ->after('content_html')
                    ->nullable()
                    ->default(null);
            }

            if(!Schema::hasColumn('rainlab_blog_posts', 'children_tag_list'))
            {
                $table->text('children_tag_list')
//                    ->after('content_html')
                    ->nullable()
                    ->default(null);
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
