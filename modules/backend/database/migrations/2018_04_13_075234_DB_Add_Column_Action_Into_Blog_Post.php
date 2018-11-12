<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBAddColumnActionIntoBlogPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rainlab_blog_posts', function ($table) {
            if (!Schema::hasColumn('rainlab_blog_posts', 'action'))
            {
                $table->integer('action')
                    ->after('status')
                    ->nullable()
                    ->default(1);
            }
            if (!Schema::hasColumn('rainlab_blog_posts', 'approved'))
            {
                $table->integer('approved')
                    ->after('action')
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
            $table->dropColumn('action');
            $table->dropColumn('approved');
        });
    }
}
