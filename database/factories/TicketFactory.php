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
            'name' => $this->faker->boolean(90) ? $this->faker->name() : null,
            'converted_name' => $this->faker->name(),
            'email' => $this->faker->boolean(90) ? $this->faker->safeEmail() : null,
            'tel' => $this->faker->boolean(90) ? $this->faker->phoneNumber() : null,
            'entered_at' => $this->faker->boolean(30) ? $this->faker->dateTime() : null,
            'tel_reserved_flag' => $this->faker->boolean(20),
        ];
    }
}
