<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categories;

class Product extends Model
{
    protected $fillable = [
         'productName', 'quantity', 'price','category_id','image','desc','statut'
    ];

   public function Categories(){
       
       return $this->belongsTo('App\Categories' , 'category_id');
   }
    
   public function user()
   {
       return $this->belongsToMany('\App\User', 'productuser' , 'product_id', 'user_id');
   }
   public function cart()
   {
       return $this->hasMany('App\Cart', 'product_id');
   }

   public function order(){
    
    return $this->belongsTo(Order::class);
 }
 
}