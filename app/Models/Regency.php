<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Regency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city'
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function customers(): HasMany
    {
        return $this->hasMany(Customers::class);
    }
     public function riders(): HasMany
    {
        return $this->hasMany(Rider::class);
    }
      public function langganan(): HasMany
    {
        return $this->hasMany(Langganan::class);
    }
      public function orders(): HasMany
    {
        return $this->hasMany(Langganan::class);
    }
    
}
