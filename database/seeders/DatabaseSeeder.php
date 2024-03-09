<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $role = Role::create([
            'name' => 'Administrator',
        ]);
        User::create([
            'name' => 'REII Administrator',
            'email' => 'admin-reii@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
        ]);

        $role = Role::create([
            'name' => 'Business Office',
        ]);
        User::create([
            'name' => 'Business Office',
            'email' => 'businessoffice@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
        ]);

        $role = Role::create([
            'name' => 'Teacher',
        ]);
        User::create([
            'name' => 'Teacher',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
        ]);
    }
}
