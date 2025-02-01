<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $guarded = [];

    protected $with = ['category'];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sale_item():HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
}