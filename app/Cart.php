<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Auth;
use Product;
use User;


class Cart extends Model
{

    protected $fillable = [
        'user_id', 'product_id','quantity'
   ];

    protected $guarded = [];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }


}