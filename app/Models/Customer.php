<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function sales():HasMany
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }
}