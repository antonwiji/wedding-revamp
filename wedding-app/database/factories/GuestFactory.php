<?php

namespace Database\Factories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'             => $this->faker->name(),
            'phone'            => $this->faker->phoneNumber(),
            'email'            => $this->faker->optional()->safeEmail(),
            'category'         => $this->faker->randomElement(['family', 'friend', 'colleague', 'vip']),
            'invitation_code'  => strtoupper(\Illuminate\Support\Str::random(8)),
            'max_attendees'    => $this->faker->numberBetween(1, 4),
            'rsvp_status'      => $this->faker->randomElement(['pending', 'attending', 'not_attending']),
            'rsvp_note'        => $this->faker->optional()->sentence(),
            'confirmed_at'     => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
