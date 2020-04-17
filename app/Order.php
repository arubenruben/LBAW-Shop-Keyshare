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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'number';

    /**
     * The user this offer belongs to
     */
    public function buyer() {
        return $this->belongsTo('App\User', 'buyer');
    }

    /**
     * The keys this offer has
     */
    public function keys() {
        return $this->hasMany('App\Key', 'orders');
    }
}
