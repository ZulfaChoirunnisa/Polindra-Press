<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Pengaju;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = User::create([
            'username' => 'admin',
            'password' => bcrypt('password'),
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]);
        if ($user) {
            Admin::create([
                'user_id' => $user->id,
                'name' => 'admin',
            ]);
        }

        $user = User::create([
            'username' => 'pengaju',
            'password' => bcrypt('password'),
            'email' => 'pengaju@gmail.com',
            'role' => 'pengaju',
        ]);
        if ($user) {
            Pengaju::create([
                'user_id' => $user->id,
                'name' => 'pengaju',
            ]);
        }

        $user = User::create([
            'username' => 'adisuheryadi',
            'password' => bcrypt('password'),
            'role' => 'pengaju',
            'email' => 'adusuheryadi@gmail.com'
        ]);
        if ($user) {
            Pengaju::create([
                'user_id' => $user->id,
                'name' => 'pengaju',
            ]);
        }

        $user = User::create([
            'username' => 'rahmatullah',
            'password' => bcrypt('password'),
            'role' => 'pengaju',
            'email' => 'rahmatullah@gmail.com'
        ]);
        if ($user) {
            Pengaju::create([
                'user_id' => $user->id,
                'name' => 'pengaju',
            ]);
        }
    }
}
