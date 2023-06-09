<?php

namespace App\Models;

use App\Models\Flowers;
use App\Models\Regency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'regencies_id',
        'phone',
        'notes',
        'image',
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
    public function pesanans(): HasMany
    {
        return $this->HasMany(Pesanan::class, 'langganan_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
