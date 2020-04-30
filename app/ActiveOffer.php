<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveOffer extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'offer_id';

    /**
     * The active offer
     */
    public function offer() {
        return $this->belongsTo('App\Offer');
    }
}
