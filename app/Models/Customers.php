<?php

namespace App\Models;

use App\Models\Regency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customers extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function regencies(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    
}
