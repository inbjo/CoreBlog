<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有用户 ID 数组，如：[1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();

        // 所有话题 ID 数组，如：[1,2,3,4]
        $post_ids = Post::all()->pluck('id')->toArray();

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $comments = factory(Comment::class)
            ->times(1000)
            ->make()
            ->each(function ($comment, $index)
            use ($user_ids, $post_ids, $faker)
            {
                // 从用户 ID 数组中随机取出一个并赋值
                $comment->user_id = $faker->randomElement($user_ids);

                // 话题 ID，同上
                $post_id=$faker->randomElement($post_ids);
                $comment->post_id = $post_id;
                Post::find($post_id)->increment('comment_count');
            });

        // 将数据集合转换为数组，并插入到数据库中
        Comment::insert($comments->toArray());
    }
}
