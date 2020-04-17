<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'offer';

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The user this offer belongs to
     */
    public function seller() {
        return $this->belongsTo('App\User');
    }

    /**
     * The product this offer is associated with
     */
    public function product() {
        return $this->belongsTo('App\Product');
    }

    /**
     * The platform this offer is associated with
     */
    public function platform() {
        return $this->belongsTo('App\Platform');
    }

    /**
     * Keys this offer has
     */
    public function keys() {
        return $this->hasMany('App\Key');
    }

    /**
     * Discounts this offer has
     */
    public function discounts() {
        return $this->hasMany('App\Discount');
    }
}
