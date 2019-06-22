<?php

use App\Models\Category;
use App\Models\Link;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //分类
        Category::create([
            'name' => '默认分类',
            'slug' => 'default',
            'post_count' => 1,
            'sort' => 0,
            'description' => '默认分类',
        ]);
        //标签
        Tag::create([
            'name' => 'hello'
        ]);
        //文章
        DB::table('posts')->insert([
            'title' => 'Hello Word!',
            'slug' => 'hello-world',
            'keyword' => 'Hello Word!',
            'description' => 'Hello Word!',
            'cover' => '/images/hello.jpg',
            'content' => '### Hello Word!',
            'status' => 1,
            'user_id' => 1,
            'category_id' => 1,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('post_tag')->insert([
            'post_id' => 1,
            'tag_id' => 1,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
        //友链
        Link::create([
            'name' => '裤裆老湿',
            'url' => 'https://www.inbjo.com',
        ]);
    }
}
