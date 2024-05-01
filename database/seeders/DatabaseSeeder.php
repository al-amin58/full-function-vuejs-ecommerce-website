<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create(
            [
                'name'      => 'Admin',
                'email'     => 'admin@admin.com',
                'password'  => 12345678,
                'type'      => 'admin'
            ]
        );
        \App\Models\User::factory()->create(
            [
                'name'      => 'Customer',
                'email'     => 'Customer@Customer.com',
                'password'  => '12345678',
                'type'      => 'Customer'
            ]
        );
    }
}
