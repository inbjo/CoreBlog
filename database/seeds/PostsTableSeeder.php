<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();
        $category_ids = Category::all()->pluck('id')->toArray();
        $faker = app(Faker\Generator::class);
        $posts = factory(Post::class)
            ->times(100)
            ->make()
            ->each(function ($post, $index)
            use ($user_ids, $category_ids, $faker) {
                $post->user_id = $faker->randomElement($user_ids);
                $post->category_id = $faker->randomElement($category_ids);
            });
        Post::insert($posts->toArray());

    }
}
