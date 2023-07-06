<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        $start_date = Carbon::now()->subYear();
        $end_date = Carbon::now();
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'type' => 0,
            'is_active' => 1,
            'email_verified_at' => now(),
            'created_at' => randomDateInRange($start_date, $end_date),
            'password' => 123456, // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
