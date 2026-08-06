<?php

namespace Database\Factories;

use App\Models\Consultation;
use App\Models\TextBrut;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Consultation>
 */
class ConsultationFactory extends Factory
{
    protected $model = Consultation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text_brut_id' => TextBrut::factory(),
            'chief_complaint' => fake()->sentence(),
            'symptoms' => fake()->words(3),
            'observations' => fake()->paragraph(),
            'diagnosis' => fake()->sentence(),
            'follow_up_date' => fake()->date(),
            'validated_at' => fake()->dateTime(),
        ];
    }
}
