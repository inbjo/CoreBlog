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
            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->string('keyword', 255)->nullable();
            $table->string('description', 1024)->nullable();
            $table->string('cover')->nullable();
            $table->longText('content');
            $table->unsignedInteger('view_count')->default(0);
            $table->boolean('status')->default(1);
            $table->unsignedInteger('publish_time')->default(0);
            $table->string('password')->nullable();
            $table->boolean('allow_comment')->default(true);
            $table->unsignedInteger('category_id')->unsigned()->index();
            $table->unsignedInteger('user_id')->unsigned()->index();
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
