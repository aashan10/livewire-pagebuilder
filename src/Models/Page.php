<?php

namespace Aashan\LivewirePageBuilder\Models;

use Aashan\LivewirePageBuilder\Factories\PageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    /** @use HasFactory<\Aashan\LivewirePageBuilder\Factories\PageFactory> */
    use HasFactory;

    protected $fillable = ['title', 'slug', 'published'];

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class);
    }

    protected static function newFactory(): PageFactory
    {
        return PageFactory::new();
    }
}
