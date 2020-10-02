<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    protected $fillable = [
        'user_id', 'token'
    ];
}
