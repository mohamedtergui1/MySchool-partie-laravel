<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userImage = ["adnan.jpg" , "bilal.jpg", "bolbola.jpg", "elaarab.jpg", "elkhaili.jpg", "elmorjani.jpg", "ghofran.jpg", "lhcen.jpg", "li9ama.jpg", "ossama.jpg", "smail.jpg", "soulaiman.jpg", "waheli.jpg", "wissal.jpg", "yassin.jpg", "yassirAit.jpg", "zaid.jpg", "zehra.jpg"];
        return [
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'grade_id' => rand(1,3),  
            'address' => $this->faker->address,
            'number_phone' => $this->faker->phoneNumber,
            'date_d_inscription' => $this->faker->date,
            'role_id' => 3,
            'image' => $userImage[rand(0, count($userImage) - 1)],
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
