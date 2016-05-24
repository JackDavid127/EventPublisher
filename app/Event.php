<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $primaryKey = 'event_id';
    public $timestamps = false;
    public function getUser(){
        return $this->belongsToMany("App\Event", 'user_event', 'event_id', 'event_id')->get();
    }
}
