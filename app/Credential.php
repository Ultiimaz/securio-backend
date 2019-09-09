<?php

namespace App;

use App\Events\CreateCredentialEvent;
use App\Events\DeleteCredentialEvent;
use App\Events\UpdateCredentialEvent;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
 protected $dispatchesEvents = [
     'created' => CreateCredentialEvent::class,
     'updated' => UpdateCredentialEvent::class,
     'deleted' => DeleteCredentialEvent::class
 ];
 protected $fillable = [

 ];
}
