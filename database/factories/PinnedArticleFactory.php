<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PinnedArticle;

class PinnedArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PinnedArticle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(-10000, 10000),
            'news_source' => $this->faker->numberBetween(-10000, 10000),
            'resource_id' => $this->faker->numberBetween(-10000, 10000),
            'softdeletes' => $this->faker->word,
        ];
    }
}
