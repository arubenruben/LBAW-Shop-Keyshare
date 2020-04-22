<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Offer extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $dates = [
        'end_date',
        'start_date',
    ];

    /**
     * The user this offer belongs to
     */
    public function seller() {
        return $this->belongsTo('App\User', 'user_id');
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

    public function discountPrice(){

        foreach($this->discounts()->getResults() as $discount){
            if($discount->start_date < date("Y-m-d") && date("Y-m-d") < $discount->end_date){
                return number_format((float)($this->price - ($this->price * $discount->rate/100)), 2, '.', '');
            }
        }

        return $this->price;
    }
}
