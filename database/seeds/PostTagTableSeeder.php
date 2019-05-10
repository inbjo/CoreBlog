<?php

use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有话题 ID 数组，如：[1,2,3,4]
        $post_ids = Post::all()->pluck('id')->toArray();

        // 所有标签 ID 数组，如：[1,2,3,4]
        $tag_ids = Tag::all()->pluck('id')->toArray();

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $posttags = factory(PostTag::class)
            ->times(100)
            ->make()
            ->each(function ($posttag, $index)
            use ($post_ids, $tag_ids, $faker)
            {
                // 从用户 ID 数组中随机取出一个并赋值
                $posttag->post_id = $faker->randomElement($post_ids);

                // 话题分类，同上
                $posttag->tag_id = $faker->randomElement($tag_ids);
            });

        // 将数据集合转换为数组，并插入到数据库中
        PostTag::insert($posttags->toArray());
    }
}
