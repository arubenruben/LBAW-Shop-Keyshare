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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'key';  
    
    /**
     * The offer the key is related to 
     */
    public function offer(){
        return $this->belongsTo('App\Offer', 'offer');
    }

    /**
     * The offer the key is related to
     */
    public function orders(){
        return $this->belongsTo('App\Order', 'orders');
    }

    /**
     * The report the key is related to
     */
    public function report(){
        return $this->hasOne('App\Report', 'key');
    }
}
