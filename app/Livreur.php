<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
      protected $fillable = [
        'nom', 'numero','adresse'
   ];
}
