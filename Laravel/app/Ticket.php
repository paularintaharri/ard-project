<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lat', 'lon', 'street_address', 'postal_code', 'city', 'country', 'amount', 'comment'
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }
}
