<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'date', 'slug'
    ];

    public function langganan(): HasMany
    {
        return $this->hasMany(Langganan::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Orders::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
