<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Engineer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'engineeruser';
    protected $primaryKey = 'id';
    protected $fillable = ['id','email','password'];
    protected $hidden = ['password'];
}
