<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Report extends Model
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The user who received the report
     */
    public function reported(){
        return $this->belongsTo('App\User', 'reported_id');
    }

    /**
     * The user who gave the report
     */
    public function reporter(){
        return $this->belongsTo('App\User', 'reporter_id');
    }

    /**
     * The messages the users wrote on the report page
     */
    public function messages(){
        return $this->hasMany('App\Message');
    }

    /**
     * The key that the report is related to
     */
    public function key(){
        return $this->belongsTo('App\Key');
    }
}
