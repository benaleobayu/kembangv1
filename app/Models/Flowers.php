<?php

namespace App\Models;

use App\Models\Langganan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flowers extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'price'
    ];

    public function langganan(): HasMany
    {
        return $this->hasMany(Langganan::class);
    }
}
