<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use Notifiable;

    protected $guard = 'adminuser';
    protected $primaryKey = 'id';
    protected $fillable = ['id','username','password'];
    protected $hidden = ['password'];
}
