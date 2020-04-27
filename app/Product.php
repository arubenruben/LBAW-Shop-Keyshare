<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The image this product has
     */
    public function image() {
        return $this->belongsTo('App\Image');
    }

    /**
     * The category this product has
     */
    public function category() {
        return $this->belongsTo('App\Category');
    }

    /**
     * The platforms this offer is associated with
     */
    public function platforms() {
        return $this->belongsToMany('App\Platform', 'product_has_platform', 'product', 'platform');
    }

    /**
     * The genres this offer is associated with
     */
    public function genres() {
        return $this->belongsToMany('App\Genre', 'product_has_genre', 'product', 'genre');
    }
}
