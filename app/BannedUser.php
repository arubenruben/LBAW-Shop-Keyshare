<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BannedUser extends Model
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * User account that is banned
     */
    public function user() {
        return $this->belongsTo('App\User', 'id');
    }

    /**
     * The appeal linked to this user
     */
    public function appeal() {
        return $this->hasOne('App\BanAppeal', 'id');
    }
}
