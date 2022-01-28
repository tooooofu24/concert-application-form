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
        $address_data = explode(" ", $this->faker->address());
        if (isset($address_data[3])) {
            $address = $address_data[2] . ' ' . $address_data[3];
        } else {
            $address = $address_data[2];
        }
        return [
            // 'uid' => Str::random(30),
            'name' => $this->faker->name(),
            'converted_name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'tel' => $this->faker->phoneNumber(),
            'zip' => substr($this->faker->postcode(), 0, 3) . '-' . substr($this->faker->postcode(), 3),
            'address' => $address,
            'entered_at' => $this->faker->boolean() ? $this->faker->dateTime() : null
        ];
    }
}
