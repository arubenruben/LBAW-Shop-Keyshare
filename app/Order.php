<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'number';

    /**
     * The user this order belongs to
     */
    public function buyer() {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * The keys this order has
     */
    public function keys() {
        return $this->hasMany('App\Key', 'order_id');
    }
}
