<?php

namespace App;
use App\Traits\Friendable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\profile;

class User extends Authenticatable {

    use Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'slug', 'pic'
    ];

    public function isRole(){
        return $this->role; // mysql table column
    }
    protected $hidden = [
        'password', 'remember_token','password'
    ];

      public function profile() {
        return $this->hasOne('App\Profile');
    }

}
