<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'customeruser';
    protected $primaryKey = 'id';
    protected $fillable = ['id','cust_email','password'];
    protected $hidden = ['password'];
}
