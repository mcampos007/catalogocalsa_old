<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //$client->carts
    public function carts()
    {
    	return $this->hasMany(Cart::class);
    }

    //$client->invoices:
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    
}
