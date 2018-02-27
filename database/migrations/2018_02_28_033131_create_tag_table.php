<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tag_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('parent_tag_group_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_tag_id')->references('id')->on('tag_groups');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('tag_group_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tag_group_id')->references('id')->on('tag_groups');
        });

        Schema::create('article_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tag_id');
            $table->unsignedInteger('article_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('article_id')->references('id')->on('articles');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tag');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_groups');
    }
}
