<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Reservation;
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
        User::factory()
            ->count(1000)
            ->has(Apartment::factory()->count(3))
            ->create();

        // Get users and appartements
        // Create reservations

        $users = User::all();
        $apartements = Apartment::all();

        $users->each(function ($user) use ($apartements) {
            Reservation::factory()
                ->count(100)
                ->for($user, 'user')
                ->for($apartements->random(), 'apartment')
                ->create();
        });
    }
}
