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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'offer_id'
    ];

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

    /**
     * The feedback the key is related to
     */
    public function feedback(){
        return $this->hasOne('App\Feedback');
    }
}
