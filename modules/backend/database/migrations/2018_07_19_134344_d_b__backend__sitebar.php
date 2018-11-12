<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DBBackendSitebar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('backend_sitebar', function ($table) {
             $table->engine = 'InnoDB';
             $table->increments('id');
             $table->string('name');
             $table->integer('type');
             $table->integer('location')->nullable();
             $table->integer('active')->nullable()->default(0);
             $table->text('content_type')->nullable();
             $table->text('description')->nullable();
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
        Schema::dropIfExists('backend_sitebar');
    }
}
