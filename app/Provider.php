<?php

namespace App;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasUUID;
    protected $uuidFieldName = 'id';
    protected $fillable = [
        'display_name','email'
    ];
}
