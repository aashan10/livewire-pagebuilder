<?php

declare(strict_types=1);

namespace Aashan\LivewirePageBuilder\UI\Concerns;

use Illuminate\Validation\Rule;

trait HasRules
{
    public array $rules = [];

    public function rules(array $rules): static
    {
        $this->rules = $rules;

        return $this;
    }

    public function rule(string|Rule $rule): static
    {
        if (is_string($rule)) {
            $rules = explode('|', $rule);
            foreach ($rules as $rule) {
                $this->rules[] = $rule;
            }
        } else {
            $this->rules[] = $rule;
        }

        return $this;
    }
}
