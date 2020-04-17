<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The image this product has
     */
    public function product() {
        return $this->hasOne('App\Image', 'image');
    }

    /**
     * The platform this offer is associated with
     */
    public function platforms() {
        return $this->hasManyThrough('App\Platform', 'App\ProductHasPlatform', 'product');
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
