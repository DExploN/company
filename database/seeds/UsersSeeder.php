<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return User::create([
            'name' => 'Admin',
            'email' => 'admin@softinvent.ru',
            'password' => Hash::make('bigsecret'),
        ]);
    }
}
