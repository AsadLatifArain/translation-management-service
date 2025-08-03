<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translation>
 */
class TranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locales = ['en', 'fr', 'es', 'de', 'ar'];
        $tags = ['mobile', 'desktop', 'web'];

        return [
            'key' => 'key_' . $this->faker->unique()->uuid(),
            'locale' => $this->faker->randomElement($locales),
            'translation' => $this->faker->sentence(),
            'tag' => $this->faker->randomElement($tags),
        ];
    }
}
