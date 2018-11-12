<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBContentComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_comment', function ($table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->text('content');
            $table->integer('post_id');
            $table->integer('user_updated_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_comment');
    }
}
