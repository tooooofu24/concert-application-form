<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'converted_name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'tel' => $this->faker->phoneNumber(),
            'entered_at' => $this->faker->boolean() ? $this->faker->dateTime() : null
        ];
    }
}
