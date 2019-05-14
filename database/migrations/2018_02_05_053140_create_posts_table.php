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
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->string('keyword',255)->nullable()->comment('关键词');
            $table->string('description',1024)->nullable()->comment('文章描述');
            $table->string('cover')->nullable()->comment('封面');
            $table->text('content')->comment('文章内容');
            $table->integer('comment_count')->unsigned()->defalut(0)->comment('评论次数');
            $table->integer('view_count')->unsigned()->defalut(0)->comment('浏览次数');
            $table->integer('favorite_count')->unsigned()->defalut(0)->comment('点赞次数');
            $table->smallInteger('status')->comment('文章状态 0回收站 1草稿 2发布');
            $table->integer('publish_time')->unsigned()->comment('定时发布时间 0不定时');
            $table->timestamps();
            $table->integer('category_id')->unsigned()->comment('分类ID');
            $table->integer('user_id')->unsigned()->comment('用户ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('posts');
    }
}
