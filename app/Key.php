<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Key extends Model
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The offer the key is related to 
     */
    public function offer(){
        return $this->belongsTo('App\Offer');
    }

    /**
     * The order the key is related to
     */
    public function order(){
        return $this->belongsTo('App\Order', 'order_id', 'number');
    }

    /**
     * The report the key is related to
     */
    public function report(){
        return $this->hasOne('App\Report');
    }
}
