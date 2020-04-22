<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cart extends Model
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * the user this cart entries belongs to
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * the offer this cart is realted to 
     */
    public function offer() {
        return $this->belongsTo('App\Offer');
    }
}