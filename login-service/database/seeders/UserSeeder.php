<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate a password
        $password = 'secret'; // You can change this to a dynamically generated password if needed

        // Create a user with a predefined mobile and password
        $user = User::factory()->create([
            'password' => bcrypt($password), // Ensure the password is hashed
        ]);

        // Print the mobile number and password
        $this->command->info("User created with mobile: {$user->mobile} and password: {$password}");
    }
}
