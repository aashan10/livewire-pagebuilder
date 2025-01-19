<?php

use Aashan\LivewirePagebuilder\Blocks\Examples\ExampleBlock;

return [
    'block_path' => 'blocks',
    'blocks' => [
        ExampleBlock::name() => ExampleBlock::class,
    ],
];
