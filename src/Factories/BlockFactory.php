<?php

namespace Aashan\LivewirePageBuilder\Factories;

use Aashan\LivewirePageBuilder\Models\Block;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Aashan\LivewirePageBuilder\Models\Block>
 */
class BlockFactory extends Factory
{
    protected $model = Block::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $availableClasses = config('livewire-pagebuilder.blocks', []);

        if (empty($availableClasses)) {
            throw new \RuntimeException('No registered blocks found. Please register blocks in configuration under `livewire-pagebuilder.blocks`');
        }

        $rand = collect($availableClasses)->random();

        $fields = $rand::configure();

        $data = [];
        foreach ($fields as $field) {
            $data[$field->name] = $field->default;
        }

        return [
            'class' => $rand,
            'data' => json_encode($data),
            'sort_order' => fake()->randomDigit(),
        ];
    }
}
