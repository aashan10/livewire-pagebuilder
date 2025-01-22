<?php

namespace Aashan\LivewirePageBuilder\Models;

use Aashan\LivewirePageBuilder\Factories\BlockFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Block extends Model
{
    /** @use HasFactory<\Aashan\LivewirePageBuilder\Factories\BlockFactory> */
    use HasFactory;

    protected $fillable = ['page_id', 'data', 'class', 'sort_order', 'published'];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    protected static function newFactory(): BlockFactory
    {
        return BlockFactory::new();
    }
}
