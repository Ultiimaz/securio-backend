<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministrationRelation extends Model
{
    protected $casts = [
        'administration_id' => 'integer'
    ];
    public function administration(){
        return $this->hasOne(Administration::class,'id','administration_id');
    }
}
