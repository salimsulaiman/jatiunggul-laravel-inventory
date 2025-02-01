<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $with = ['user', 'customer'];

    protected $casts = [
        'sales_date' => 'datetime',
    ];

    public function customer():BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sale_item():HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
}
