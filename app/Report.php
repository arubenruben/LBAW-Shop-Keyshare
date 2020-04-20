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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'report';
    
    /**
     * The user who received the report
     */
    public function reportee(){
        return $this->belongsTo('App\User', 'reportee');
    }

    /**
     * The user who gave the report
     */
    public function reporter(){
        return $this->belongsTo('App\User', 'reporter');
    }

    /**
     * The messages the users wrote on the report page
     */
    public function messages(){
        return $this->hasMany('App\Message', 'report');
    }

    /**
     * The key that the report is related to
     */
    public function key(){
        return $this->belongsTo('App\Key', 'key');
    }
    
}
