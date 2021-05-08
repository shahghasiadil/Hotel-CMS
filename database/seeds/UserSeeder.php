<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->user_name = "admin";
        $user->password = Hash::make("admin");
        $user->type = 'admin';
        $user->save();

        $user1 = new User();
        $user1->user_name = "user";
        $user1->password = Hash::make('user');
        $user1->type = 'user';
        $user1->save();
    }
}
