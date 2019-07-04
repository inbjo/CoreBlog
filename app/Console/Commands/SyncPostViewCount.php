<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class SyncPostViewCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:sync-view-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sync post view count to database';

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
        Post::chunk(100, function ($posts) {
            foreach ($posts as $post) {
                if ($post->view_count != $post->visits()->count()) {
                    $post->view_count = $post->visits()->count();
                    $post->save();
                }
            }
        });
        $this->info("Sync Post View Count Finish!");
    }
}
