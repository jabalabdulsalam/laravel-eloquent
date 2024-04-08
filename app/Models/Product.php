<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Product extends Model
{
    protected $table = "products";
    protected $primaryKey = "id";
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, "product_id", "id");
    }

    function likedByCustomers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, "customers_like_products", "product_id", "customer_id")
            ->withPivot("created_at")
            ->using(Like::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, "imageable");
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, "commentable");
    }

    public function latestComment(): MorphOne
    {
        return $this->morphOne(Comment::class, "commentable")
            ->latest("created_at");
    }

    public function oldestComment(): MorphOne
    {
        return $this->morphOne(Comment::class, "commentable")
            ->oldest("created_at");
    }
}