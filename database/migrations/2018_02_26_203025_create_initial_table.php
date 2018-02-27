<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hako_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hakos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->unsignedInteger('hako_type_id');
            $table->text('content');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('hako_type_id')->references('id')->on('hako_types');
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->unique()->nullable();
            $table->string('title')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('article_hako', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hako_id');
            $table->unsignedInteger('article_id');

            $table->integer('order')->nullable();
            $table->boolean('is_valid')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('hako_id')->references('id')->on('hakos');
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
        Schema::dropIfExists('hako_article');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('hakos');
        Schema::dropIfExists('hako_types');
    }
}
