<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBAddColumnWorkflowIdToPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rainlab_blog_posts', function ($table) {
            if (!Schema::hasColumn('rainlab_blog_posts', 'workflow_id')) {
                $table->integer('workflow_id')
                    ->after('status')
                    ->nullable()
                    ->default(0);
            }

            if (!Schema::hasColumn('rainlab_blog_posts', 'count_approve')) {
                $table->integer('count_approve')
                    ->after('reviewer_id')
                    ->nullable()
                    ->default(0);
            }

            if (!Schema::hasColumn('rainlab_blog_posts', 'is_update')) {
                $table->integer('is_update')
                    ->after('has_comment')
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
