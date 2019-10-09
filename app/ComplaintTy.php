<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplaintTy extends Model
{
    protected $fillable = ['id', 'ct_name', 'ct_charges'];
}
