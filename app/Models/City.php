<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'state_id',
        'name',
        'slug',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}