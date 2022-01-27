<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user->fill([
            'name' => env('ADMIN_USER_NAME'),
            'email' => env('ADMIN_USER_PASSWORD'),
            'password' => Hash::make(env('ADMIN_USER_EMAIL')),
        ])->save();
    }
}
