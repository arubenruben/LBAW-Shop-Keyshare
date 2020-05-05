<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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
        'username',
        'email',
        'birth_date',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The offers the user has
     */
    public function offers(){
        return $this->hasMany('App\Offer');
    }

    /**
     * The active offers the user has
     */
    public function activeOffers(){
        return $this->hasMany('App\Offer')->whereNull('final_date');
    }

    /**
     * The past offers the user has
     */
    public function pastOffers(){
        return $this->hasMany('App\Offer')->whereNotNull('final_date');
    }


    /**
     * The cart entries the user has
     */
    public function cart(){
        return $this->hasMany('App\Cart');
    }

    /**
     * The feedbacks the user has given
     */
    public function feedback(){
        return $this->hasMany('App\Feedback');
    }

    /**
     * The orders the user has purchased
     */
    public function orders(){
        return $this->hasMany('App\Order');
    }

    /**
     * The reports the user has given
     */
    public function reportsGiven(){
        return $this->hasMany('App\Report', 'reporter_id');
    }

    /**
     * The reports given to the user
     */
    public function reportsReceived(){
        return $this->hasMany('App\Report', 'reported_id');
    }

    /**
     * The messages the user writes
    */
    public function message(){
        return $this->hasMany('App\Message');
    }

    /**
     * User has one profile picture
     */
    public function picture(){
        return $this->belongsTo('App\Picture');
    }

    /**
     * Returns true if user is banned
     */
    public function banned(){
        return BannedUser::find($this->id) !== null;
    }
}
