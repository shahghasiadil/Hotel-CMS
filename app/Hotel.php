<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = ['name', 'stars', 'address'];

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
