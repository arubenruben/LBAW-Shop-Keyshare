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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'regular_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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
    public function offer(){
        return $this->hasMany('App\Offer', 'seller');
    }

    
    /**
     * The cart entries the user has
     */
    public function cart(){
        return $this->hasMany('App\Cart', 'buyer');
    }

    /**
     * The feedbacks the user has given
     */
    public function feedback(){
        return $this->hasMany('App\Feedback', 'buyer');
    }

    /**
     * The orders the user has purchased
     */
    public function orders(){
        return $this->hasMany('App\Orders', 'buyer');
    }

    /**
     * The reports the user has given
     */
    public function reportee(){
        return $this->hasMany('App\Report', 'reportee');
    }

    /**
     * The reports given to the user
     */
    public function reporter(){
        return $this->hasMany('App\Report', 'reporter');
    }

    /**
     * The messages the user writes
    */
    public function message(){
        return $this->hasMany('App\Message', 'regular_user');
    }


}
