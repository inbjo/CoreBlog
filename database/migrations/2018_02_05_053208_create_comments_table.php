<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned()->comment('文章ID');
            $table->integer('parent_id')->unsigned()->defalut(0)->comment('父评论id');
            $table->integer('user_id')->unsigned()->comment('用户ID');
            $table->text('content')->comment('评论内容');
            $table->string('agent')->comment('信息头')->nullable();
            $table->string('ip')->comment('评论者IP地址')->nullable();
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
        Schema::dropIfExists('comments');
    }
}
