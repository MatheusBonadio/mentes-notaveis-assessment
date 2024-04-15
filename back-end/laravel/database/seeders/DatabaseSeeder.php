<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Address;
use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'email@email.com',
            'password' => bcrypt('password'),
        ]);

        User::factory(5)->create();
        State::factory(5)->create();
        City::factory(20)->create();
        Address::factory(10)->create();
    }
}
