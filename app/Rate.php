<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Rate extends Model
{

    protected $fillable = ['from', 'to', 'children_rate_per_night', 'adult_rate_per_night', 'hotel_id', 'amount'];
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
