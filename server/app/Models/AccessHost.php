<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessHost extends Model
{
    protected $fillable = [
        'title', 'link_sign_in', 'host_login', 'host_password', 'ftp_server', 'ftp_login', 'ftp_password', 'comment'
    ];
}
