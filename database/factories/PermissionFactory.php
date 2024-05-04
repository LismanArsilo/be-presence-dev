<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'date' => $this->faker->date(),
            'reason' => $this->faker->text(),
            'img_proof' => $this->faker->imageUrl(),
            'is_approved_lead' => $this->faker->boolean(),
            'is_approved_manag' => $this->faker->boolean(),
        ];
    }
}
