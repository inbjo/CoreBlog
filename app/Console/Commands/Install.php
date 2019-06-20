<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '安装博客系统';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('key:generate'); //生成key
        Artisan::call('route:cache'); //缓存路由
        Artisan::call('config:cache'); //缓存配置
        Artisan::call('storage:link'); //创建软连接
        Artisan::call('migrate --seed'); //创建表并填充假数据
        Artisan::call('search:sync-posts'); //同步全文索引
        $this->info('安装完毕 ^_^');
    }
}
