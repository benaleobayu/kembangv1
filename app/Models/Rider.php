<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rider extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'regencies_id',
        'phone',
        'dob',
    ];

    public function regencies(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    public function scopeFilters($query, array $filters)
    {
      $query->when($filters['search'] ?? false, fn($query, $search) => 
      $query->where('name', 'like', '%' . $search . '%' )
      ->orWhere('address', 'like', '%' . $search . '%')
    );
    }
}
