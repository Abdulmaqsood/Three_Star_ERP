<?php

namespace Database\Seeders;

use App\Models\Admin;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@email.com',
        ]);
        // Admin::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@email.com',
        //     'role' => 'super',
        //     'password' => '$2y$12$EOr/ju4tBF6AyDg2/Wv4dOlOkItn9lCSRE9yqzUjP4meI3TQNMnaq',
        // ]);
        // Admin::create([
        //     'name' => 'Sub Admin',
        //     'email' => 'subadmin@email.com',
        //     'role' => 'admin',
        //     'password' => '$2y$12$EOr/ju4tBF6AyDg2/Wv4dOlOkItn9lCSRE9yqzUjP4meI3TQNMnaq',
        // ]);
    }
}
