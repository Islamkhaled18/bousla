<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Admin::create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'email' => 'super_admin@gmail.com',
            'password' => bcrypt('123456789'),
            'phone' => '01015949894',
            'role_id' => null
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
