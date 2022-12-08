<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Product;

class Categories extends Model
{

    protected $fillable = [
        'name', 'type'
   ];

   public function product(){

    return $this->hasMany('App\Product', 'category_id');
   }

 



}
