<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BanAppeal extends Model
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * Banned User that made the appeal
     */
    public function user() {
        return $this->belongsTo('App\BannedUser', 'id');
    }

    /**
     * Admin that responded to the appeal
     */
    public function admin() {
        return $this->belongsTo('App\Admin');
    }
}
