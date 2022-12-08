<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Patient;
class Cancer extends Model
{
    protected $fillable =[
        'postion',
        'stade',
        'symptom',

    ];

    public function patient()
     {
        return $this->hasMany(Patient::class, 'cancer_id');
    }

}
