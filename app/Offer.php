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
     * Append custom columns to the model
     *
     * @var array
     */
    protected $appends = ['discountPriceColumn'];

    /**
     * Define the type column to every Item object instance
     *
     * @return string
     */
    public function getDiscountPriceColumnAttribute()
    {
        return $this->discount_price();
    }

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

    /**
     * Returns the active discount of the offer
     */
    public function active_discount() {
        foreach($this->discounts as $discount){
            if($discount->start_date < date("Y-m-d") && date("Y-m-d") < $discount->end_date){
                return $discount;
            }
        }

        return null;
    }

    /**
     * Returns the discounted price of the offer
     */
    public function discount_price(){
        foreach($this->discounts as $discount){
            if($discount->start_date < date("Y-m-d") && date("Y-m-d") < $discount->end_date){
                return number_format((float)($this->price - ($this->price * $discount->rate/100)), 2, '.', '');
            }
        }

        return $this->price;
    }
}
