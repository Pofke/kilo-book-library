<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'info@libraryapi.com',
        ]);

        User::factory()->create([
            'name' => 'librarian',
            'email' => 'library@libraryapi.com',
        ]);

        User::factory()->create([
            'name' => 'John',
            'email' => 'john@libraryapi.com',
        ]);

        User::factory()->create([
            'name' => 'Peter',
            'email' => 'peter@libraryapi.com',
        ]);

        User::factory()->create([
            'name' => 'Paul',
            'email' => 'paul@libraryapi.com',
        ]);

        User::factory()->create([
            'name' => 'Jim',
            'email' => 'jim@libraryapi.com',
        ]);

        User::factory()->create([
            'name' => 'Amanda',
            'email' => 'amanda@libraryapi.com',
        ]);

    }
}
