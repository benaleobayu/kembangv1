<?php

namespace App\Models;

use App\Models\Regency;
use Illuminate\Database\Eloquent\Collection;
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
        // 'flowers_id',
        // 'total',
        'notes',
        'day_id',
        'pic'
    ];

    public function getDataByConditions($name, $address, $phone, $regencies_id, $notes, $day_id, $pic)
    {
        $data = $this->join('pesanans', 'langganans.id', '=', 'pesanans.langganan_id')
            ->join('flowers', 'pesanans.flower_id', '=', 'flowers.id')
            ->select('langganans.name', 'langganans.address', 'langganans.phone', 'langganans.regencies_id', 'langganans.notes', 'langganans.day_id', 'langganans.pic', 'flowers.name as flower_name', 'pesanans.total')
            ->where('langganans.name', $name)
            ->where('langganans.address', $address)
            ->where('langganans.phone', $phone)
            ->where('langganans.regencies_id', $regencies_id)
            ->where('langganans.notes', $notes)
            ->where('langganans.notes', $day_id)
            ->where('langganans.notes', $pic)
            ->get();

        return $data;
    }


    public function regencies(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    public function flowers(): hasMany
    {
        return $this->hasMany(Flowers::class);
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
        return $this->HasMany(Pesanan::class);
    }
    

}
