<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Image extends Model
{

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function product(){
        return $this->belongsTo('App\Product');
    }

}
