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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banned_user';

    protected $primaryKey = 'regular_user';

    /**
     * User account that is banned
     */
    public function user() {
        return $this->belongsTo('App\User', 'regular_user');
    }

    /**
     * The appeal linked to this user
     */
    public function appeal() {
        return $this->hasOne('App\BanAppeal', 'banned_user');
    }
}
