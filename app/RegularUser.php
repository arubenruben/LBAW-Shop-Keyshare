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
        return $this->hasMany('App\Offer');
    }

    
    /**
     * The offers the user has
     */
    public function cart(){
        return $this->hasMany('App\cart');
    }



       /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'image' => 0,
        'num_sells' => 0,
    ];

}
