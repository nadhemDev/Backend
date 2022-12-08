<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cancer;
class Patient extends Model
{
    protected $fillable =[
        'name',
        'prenom',
        'date_nai',
        'age_diagnostique',
        'cancer_id'
    ];

    public function Cancer(){

        return $this->belongsTo(Cancer::class , 'cancer_id');
    }
}
