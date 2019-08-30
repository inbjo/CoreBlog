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
        $user_ids = User::all()->pluck('id')->toArray();
        $post_ids = Post::all()->pluck('id')->toArray();
        $faker = app(Faker\Generator::class);
        $comments = factory(Comment::class)
            ->times(1000)
            ->make()
            ->each(function ($comment, $index)
            use ($user_ids, $post_ids, $faker) {
                $comment->user_id = $faker->randomElement($user_ids);
                $comment->post_id = $faker->randomElement($post_ids);
            });
        Comment::insert($comments->toArray());
    }
}
