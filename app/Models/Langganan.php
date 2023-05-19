<?php

namespace App\Models;

use App\Models\Regency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Langganan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'regencies_id',
        'phone',
        'flowers_id',
        'total',
        'notes',
        'day_id',
        'pic'
    ];
    public function regencies(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }
    public function flowers(): BelongsTo
    {
        return $this->belongsTo(Flowers::class);
    }
    
    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }
    
    public function customers(): BelongsTo
    {
        return $this->belongsTo(Customers::class);
    }
     public function pesanans(): HasMany
    {
        return $this->HasMany(Pesanan::class, 'langganans_id');
    }
    

}
