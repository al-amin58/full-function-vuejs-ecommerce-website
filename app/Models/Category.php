<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'name', 'image', 'parent_id'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function childrens(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->select(['id', 'parent_id', 'name', 'image']);
    }
    public function parents(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function childrenRecursive(): HasMany
    {
        return $this->childrens()->with(['childrenRecursive']);
    }
}
