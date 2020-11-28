<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('password');
        User::create([
            'name' => 'admin',
            'password' => $password,
            'email' => 'admin@admin.com'
        ]);
    }
}
