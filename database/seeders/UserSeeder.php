<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Sources\UserSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{

    /**
     * Seed Instance.
     *
     * @param $faker \Faker\Generator
     */
    public function __construct(
        protected Faker $faker
    ) {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        $seed = 10;
        $users = [];


        for ($i = 1; $i < ($seed + 1); $i++) {
            $users[] = [
                'name' => $this->faker->name(),
                'email' => 'user' . $i . '@example.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'image' => UserSource::PROFILE_PICTURES[array_rand(UserSource::PROFILE_PICTURES)],
            ];
        }

        User::insert($users);
    }
}
