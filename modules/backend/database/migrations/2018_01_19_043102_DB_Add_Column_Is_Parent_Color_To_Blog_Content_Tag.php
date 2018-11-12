<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBAddColumnIsParentColorToBlogContentTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_tag', function ($table) {
            if(!Schema::hasColumn('content_tag', 'is_parent'))
            {
                $table->integer('is_parent')
                    ->after('description')
                    ->nullable()
                    ->default(0);
            }

            if(!Schema::hasColumn('content_tag', 'tag_color'))
            {
                $table->string('tag_color')
                    ->after('description');
            }
            $table->integer('category_id')->default(0)->change();
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
