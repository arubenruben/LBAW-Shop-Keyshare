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
        return $this->belongsTo('App\User', 'seller');
    }

    /**
     * The product this offer is associated with
     */
    public function product() {
        return $this->belongsTo('App\Product', 'product');
    }

    /**
     * The platform this offer is associated with
     */
    public function platform() {
        return $this->belongsTo('App\Platform', 'platform');
    }

    /**
     * Keys this offer has
     */
    public function keys() {
        return $this->hasMany('App\Key', 'offer');
    }

    /**
     * Discounts this offer has
     */
    public function discounts() {
        return $this->hasMany('App\Discount', 'offer');
    }
}
