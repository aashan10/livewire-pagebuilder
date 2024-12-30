<?php

namespace Aashan\LivewirePageBuilder\Factories;

use Aashan\LivewirePageBuilder\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Aashan\LivewirePageBuilder\Models\Page>
 */
class PageFactory extends Factory
{
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => Str::studly($this->faker->unique()->sentence),
            'published' => Arr::random([true, false]),
        ];
    }
}
