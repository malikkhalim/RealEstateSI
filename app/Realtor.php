<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realtor extends Model
{
    protected $fillable = [
        'name','address', 'email', 'contact_number','image', "activate"

    ];


    public function listing(){

        return $this->hasOne(Listing::class);
    }

    public function som(){

        return $this->hasOne(Som::class);
    }

    public function reviews()
{
    return $this->hasMany(Review::class);
}
}
