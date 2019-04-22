<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  /*  protected $fillable = [
        'user_first_name','user_last_name', 'email','user_username','user_token','password',
    ];
*/
 protected $table = 'users';
     /*protected $fillable = array(
        'country_id',
        'country_name',
        'country_currency_code',
        'country_status',
        'country_code'
    );*/
     public $timestamps = false;  
    protected $hidden = [
        'password', 'remember_token',
    ];
}
