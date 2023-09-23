<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an administrative user
        $user = User::create([
            'name'              => 'Admin',
            'role_id'           => "1",
            'username'          => 'admin',
            'email'             => 'admin@admin.com',
            'password'          => bcrypt('Admin@123'),
            'email_verified_at' => now(),
        ]);
    }
}