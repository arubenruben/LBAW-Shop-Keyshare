<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveProduct extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'product_id';

    /**
     * The active product
     */
    public function product() {
        return $this->belongsTo('App\Product');
    }
}
