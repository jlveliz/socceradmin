<?php

use Illuminate\Database\Seeder;
use HappyFeet\Models\User;
// use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'representant';
        $password = \Hash::make($password);
        $user = User::where('username','representant')->first();
        $user->password = $password;
        $user->save();
    }
}
