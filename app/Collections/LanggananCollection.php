<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class LanggananCollection extends Collection
{
    public function getDataByConditions($name, $address, $phone, $regencies_id, $notes, $day_id, $pic)
    {
        return $this->filter(function ($item) use ($name, $address, $phone, $regencies_id, $notes, $day_id, $pic) {
            return $item->name == $name &&
                $item->address == $address &&
                $item->phone == $phone &&
                $item->regencies_id == $regencies_id &&
                $item->day_id == $day_id &&
                $item->pic == $pic &&
                $item->notes == $notes;
        });
    }
}
