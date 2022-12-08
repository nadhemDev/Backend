<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable

{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'userName', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
   //return $this->belongsToMany('App\Role');
    }

    public function Product()
    {
        return $this->belongsToMany('\App\Product', 'productuser' , 'user_id', 'product_id');
    }


    public function cart()
    {
        return $this->hasMany('App\Cart', 'user_id');
    }


    public function orders(){
        return $this->hasMany(Order::class);
    }


    

}
