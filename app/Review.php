<?php
// app/Models/Review.php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable = [
        'listing_id',
        'user_id',
        'realtor_id',
        'rating',
        'review',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function realtor()
    {
        return $this->belongsTo(Realtor::class);
    }
}
