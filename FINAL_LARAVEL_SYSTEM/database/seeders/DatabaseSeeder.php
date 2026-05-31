<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::updateOrCreate(
    ['email' => 'admin@bloomery.com'],
    ['name' => 'Admin User', 'password' => Hash::make('admin12345'), 'role' => 'admin']
);
User::updateOrCreate(
    ['email' => 'supplier@bloomery.com'],
    ['name' => 'Supplier User', 'password' => Hash::make('supplier12345'), 'role' => 'supplier']
);
User::updateOrCreate(
    ['email' => 'customer@bloomery.com'],
    ['name' => 'Customer User', 'password' => Hash::make('customer12345'), 'role' => 'customer']
);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
