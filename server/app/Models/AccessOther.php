<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessOther extends Model
{
    protected $fillable = [
        'title', 'link_sign_in', 'login', 'password', 'phone', 'email', 'comment'
    ];
}
