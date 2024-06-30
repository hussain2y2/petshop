<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'type' => $this->faker->randomElement(['credit_card, cash_on_delivery, bank_transfer']),
            'details' => $this->faker->randomElement([
                [
                    'holder_name' => $this->faker->name(),
                    'number' => $this->faker->creditCardNumber(),
                    'ccv' => $this->faker->numberBetween(100, 999),
                    'expire_date' => $this->faker->date('m y'),
                ],
                [
                    'first_name' => $this->faker->firstName(),
                    'last_name' => $this->faker->lastName(),
                    'address' => $this->faker->address(),
                ],
                [
                    'swift' => $this->faker->swiftBicNumber(),
                    'iban' => $this->faker->iban(),
                    'name' => $this->faker->name(),
                ]
            ])
        ];
    }
}
