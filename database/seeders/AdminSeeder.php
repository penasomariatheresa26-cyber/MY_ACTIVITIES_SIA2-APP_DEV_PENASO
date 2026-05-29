<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Theresse',
            'email' => 'admin@theresse.com',
            'password' => Hash::make('admin123'),
            'phone' => '09123456789',
            'address' => 'Manila, Philippines',
            'role' => 'admin',
        ]);
    }
}