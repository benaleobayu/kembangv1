<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesanan extends Model
{
    use HasFactory;

    public function langganan():BelongsTo
    {
        return $this->belongsTo(Langganan::class, 'langganans_id');
    }
    public function flowers(): BelongsTo
    {
        return $this->belongsTo(Flowers::class);
    }
    
}
