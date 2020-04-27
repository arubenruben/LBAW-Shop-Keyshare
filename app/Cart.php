<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cart extends Model
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * the user this cart entries belongs to
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
    /**
     * the offer this cart is realted to 
     */
    public function offer() {
        return $this->belongsTo('App\Offer');
    }
    public function seller(){
        return $this->hasOneThrough('App\User', 'App\Offer');
    }
    public function product(){
        return $this->hasOneThrough('App\Product', 'App\Offer');
    }
    public function discounts() {
        return $this->hasOneThrough('App\Discount','App\Offer');
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