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
            'password' => bcrypt('123456789'),
            'role' => 'admin',
        ]);
        if($user){
            Admin::create([
                'user_id' => $user->id,
                'name' => 'admin',
            ]);
        }

        $user = User::create([
            'username' => 'pengaju@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'pengaju',
        ]);
        if($user){
            Pengaju::create([
                'user_id' => $user->id,
                'name' => 'pengaju',
            ]);
        }

        $user = User::create([
            'username' => 'adisuheryadi@gmail.com',
            'password' => bcrypt('aditi1234'),
            'role' => 'pengaju',
        ]);
        if($user){
            Pengaju::create([
                'user_id' => $user->id,
                'name' => 'pengaju',
            ]);
        }

        $user = User::create([
            'username' => 'rahmatullah@gmail.com',
            'password' => bcrypt('rahmat1234'),
            'role' => 'pengaju',
        ]);
        if($user){
            Pengaju::create([
                'user_id' => $user->id,
                'name' => 'pengaju',
            ]);
        }
    }
}
