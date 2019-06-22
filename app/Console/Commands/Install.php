<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

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
        $this->info('Thanks for using');
        $this->info(' _____                    ______  _               ');
        $this->info('/  __ \                   | ___ \| |              ');
        $this->info('| /  \/  ___   _ __   ___ | |_/ /| |  ___    __ _ ');
        $this->info('| |     / _ \ | \'__| / _ \| ___ \| | / _ \  / _` |');
        $this->info('| \__/\| (_) || |   |  __/| |_/ /| || (_) || (_| |');
        $this->info(' \____/ \___/ |_|    \___|\____/ |_| \___/  \__, |');
        $this->info('                                             __/ |');
        $this->info('                                            |___/ ');
        if ($this->confirm('Whether to start the installation?')) {
            $this->info('Start Installing...');
            $this->call('key:generate');
            $this->call('route:cache');
            $this->call('config:cache');
            $this->call('storage:link');
            $this->call('migrate');

            if ($this->confirm('Do you need stuff faker data?')) {
                $this->call('db:seed');
            } else {
                $this->call('db:seed', ['--class' => 'DefaultDataSeeder']);
            }
            $this->call('search:sync-posts');


            $this->line('Next, We Need Create A Admin Account');
            $name = $this->ask('What is your name?');
            $email = $this->ask('What is your email address?');
            $password = $this->secret('What is the password?');

            User::updateOrCreate(
                ['id' => 1],
                [
                    'name' => $name,
                    'email' => $email,
                    'avatar' => generateAvatar($email),
                    'password' => bcrypt($password),
                    'email_verified_at' => Carbon::now()->toDateTimeString(),
                ]
            );

            $this->info('Create Admin Account Success!');
            $this->info('Ok, The Installation Is Complete ^_^ Enjoy It!');
        }

    }
}
