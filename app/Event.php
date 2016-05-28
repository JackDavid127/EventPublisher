<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $primaryKey = 'event_id';
    public $timestamps = false;
    public function users(){
        return $this->belongsToMany("App\User", 'user_event', 'event_id', 'user_id');
    }
}
