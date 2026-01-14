<?php

namespace Database\Factories;

use App\Models\Translation;
use App\Models\Locale;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslationFactory extends Factory
{
    protected $model = Translation::class;

    public function definition(): array
    {
        return [
            'key' => $this->faker->unique()->slug(3),
            'content' => $this->faker->sentence(8),
            'locale_id' => Locale::inRandomOrder()->value('id'),
        ];
    }
}
