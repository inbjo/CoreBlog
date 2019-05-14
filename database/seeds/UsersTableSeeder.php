<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();
        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());

        $user = User::find(1);
        $user->username = 'admin';
        $user->nickname = 'Flex';
        $user->email = '2345@mail.com';
        $user->password = bcrypt('123456');
        $user->email_verified_at=date('Y-m-d H:i:s',time());
        $user->save();
    }
}
