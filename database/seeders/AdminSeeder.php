<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = Admin::create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'password' => bcrypt('12345678'),
        ]);

        $super_admin->assignRole('super_admin');
    }
}
