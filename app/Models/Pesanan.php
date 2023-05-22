<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = ['langganan_id', 'total', 'flowers_id'];

    public function langganan():BelongsTo
    {
        return $this->belongsTo(Langganan::class);
    }
    public function flowers(): BelongsTo
    {
        return $this->belongsTo(Flowers::class);
    }
    
}
