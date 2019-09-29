<?php

use App\Models\Category;
use App\Models\Link;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
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
        //用户
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'avatar' => generateAvatar('admin@example.com'),
            'password' => bcrypt('password'),
            'bio' => '这家伙很懒什么也没写~',
            'email_verified_at' => Carbon::now()->toDateTimeString(),
        ]);
        //分类
        Category::create([
            'name' => '默认分类',
            'slug' => 'default',
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
            'name' => '酷博',
            'url' => 'https://www.inbjo.com',
        ]);
        //设置表
        DB::table('settings')->insert([
            ['key' => 'SITE_NAME', 'value' => '酷博'],
            ['key' => 'SITE_SLOGAN', 'value' => '一款优雅的博客系统'],
            ['key' => 'SITE_KEYWORD', 'value' => 'CoreBlog,酷博'],
            ['key' => 'SITE_DESCRIPTION', 'value' => 'CoreBlog酷博是一款基于Laravel开发的博客系统'],
            ['key' => 'SITE_ICP', 'value' => '京ICP证888888号'],
            ['key' => 'SITE_POLICE', 'value' => '京公网安备00000000000001号'],
            ['key' => 'AllOW_USER_CREATE_POST', 'value' => false],
            ['key' => 'VERIFY_COMMENT', 'value' => false],
            ['key' => 'WATERMARK', 'value' => false],
            ['key' => 'WATERMARK_IMAGE', 'value' => '/images/watermark.png'],
            ['key' => 'VAPTCHA_VID', 'value' => ''],
            ['key' => 'VAPTCHA_KEY', 'value' => ''],
            ['key' => 'ALI_APP_ID', 'value' => ''],
            ['key' => 'ALI_PUBLIC_KEY', 'value' => ''],
            ['key' => 'ALI_PRIVATE_KEY', 'value' => ''],
            ['key' => 'WECHAT_APP_ID', 'value' => ''],
            ['key' => 'WECHAT_MCH_ID', 'value' => ''],
            ['key' => 'WECHAT_KEY', 'value' => ''],
            ['key' => 'OSS_ACCESS_KEY', 'value' => ''],
            ['key' => 'OSS_SECRET_KEY', 'value' => ''],
            ['key' => 'OSS_ENDPOINT', 'value' => ''],
            ['key' => 'OSS_BUCKET', 'value' => ''],
            ['key' => 'STAT_CODE', 'value' => ''],
        ]);

    }
}
