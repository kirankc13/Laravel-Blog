<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('sub_title')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_desc')->nullable();
            $table->text('summary')->nullable();
            $table->bigInteger('hits')->nullable()->default(0);
            $table->longText('description')->nullable();
            $table->boolean('status',1)->default(1);
            $table->string('featured_image')->nullable();
            $table->text('tags')->nullable();
            $table->boolean('featured',1)->default(0);
            $table->integer('category_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->boolean('published',1)->default(0);
            $table->integer('task_id')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
