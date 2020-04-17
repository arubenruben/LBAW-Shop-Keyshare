<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'platform';

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
}
