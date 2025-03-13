<?php

namespace Database\Seeders;

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
        $user = User::factory()->create([
            'username' => 'Chris',
        ]);

        $plainTextToken = 'dev-token';

        $user->tokens()->create([
            'name' => 'development',
            'token' => hash('sha256', $plainTextToken),
            'abilities' => ['*'],
            'last_used_at' => null,
        ]);
    }
}
