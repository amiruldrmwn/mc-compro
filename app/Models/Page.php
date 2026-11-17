<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * A page of the website, built from sections (see App\Sections\SectionTypes).
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property bool $is_home
 * @property bool $in_menu
 * @property bool $published
 * @property int $position
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property list<array{id: string, type: string, data: array<string, mixed>}> $sections
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['title', 'slug', 'is_home', 'in_menu', 'published', 'position', 'meta_title', 'meta_description', 'sections'])]
class Page extends Model
{
    protected function casts(): array
    {
        return [
            'is_home' => 'boolean',
            'in_menu' => 'boolean',
            'published' => 'boolean',
            'position' => 'integer',
            'sections' => 'array',
        ];
    }

    /**
     * Published pages shown in the menu, in order.
     *
     * @param  Builder<Page>  $query
     */
    public function scopeMenu(Builder $query): void
    {
        $query->where('published', true)->where('in_menu', true)->orderBy('position')->orderBy('id');
    }

    public function url(): string
    {
        return $this->is_home ? url('/') : url($this->slug);
    }
}
