<?php

namespace App;

use App\Events\CreateCredentialEvent;
use App\Events\DeleteCredentialEvent;
use App\Events\UpdateCredentialEvent;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Credential extends Model
{
    use hasUUID;
    protected $fillable = [
        'application_name'
    ];
    protected $hidden = [
        'deleted_at','user_id',
    ];
    protected $uuidFieldName = 'id';
    protected $dispatchesEvents = [
     'created' => CreateCredentialEvent::class,
     'updated' => UpdateCredentialEvent::class,
     'deleted' => DeleteCredentialEvent::class
 ];
    public function getHashAttribute($hash){
//        return $this;
        return Crypt::decrypt($hash);
    }
}
