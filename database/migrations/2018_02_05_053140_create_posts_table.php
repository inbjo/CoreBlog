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
            $table->longText('content')->comment('文章内容');
            $table->unsignedInteger('comment_count')->default(0)->comment('评论次数');
            $table->unsignedInteger('view_count')->default(0)->comment('浏览次数');
            $table->unsignedInteger('favorite_count')->default(0)->comment('点赞次数');
            $table->boolean('status')->default(1)->comment('文章状态 0草稿 1发布');
            $table->integer('category_id')->unsigned()->comment('分类ID');
            $table->integer('user_id')->unsigned()->comment('用户ID');
            $table->timestamps();
            $table->softDeletes();
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
