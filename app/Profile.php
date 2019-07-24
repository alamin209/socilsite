<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
       protected $fillable = [
        'user_id','city', 'country', 'about'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
      public function user() {
        return $this->belongsTo('App\User');
    }

    protected $hidden = [
        'password', 'remember_token',
    ];
}
