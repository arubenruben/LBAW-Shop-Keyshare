<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Feedback extends Model
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
        'evaluation',
        'comment',
        'user_id',
        'key_id'
    ];

    /**
     * The buyer that is evaluating
     */
    public function buyer(){
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * The key the buyer is referring to
     */
    public function key(){
        return $this->belongsTo('App\Key');
    }
}
