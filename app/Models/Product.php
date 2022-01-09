<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id','id');
    }

    public function tags(): MorphToMany
    {
        return $this->MorphToMany(Tag::class,'taggable');
    }

    public function media(): MorphMany
    {
        return $this->MorphMany(Media::class,'mediable');
    }

    public function status()
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function feature()
    {
        return $this->featured ? 'Yes' : 'No';
    }
}
