<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appeal extends Model
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ban_appeal';

    /**
     * Banned User that made the appeal
     */
    public function user() {
        return $this->belongsTo('App\BannedUser', 'banned_user');
    }

    /**
     * Admin that responded to the appeal
     */
    public function admin() {
        return $this->belongsTo('App\Admin', 'admin');
    }
}
