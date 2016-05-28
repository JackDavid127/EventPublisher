<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'truename', 'phone', 'hobby', 'intro'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function events(){
        return $this->belongsToMany('App\Event', 'user_event', 'user_id', 'event_id');
    }

    public function friends(){
        return $this->belongsToMany('App\User', 'friends', 'user1_id', 'user2_id');
    }

    public function reqeds(){
        return $this->belongsToMany('App\User', 'requests', 'to_user_id', 'from_user_id');
    }

    public function newmsgs(){
        return $this->hasMany('App\Messages', 'to_user_id')->where('read', false)->count();
    }
}
