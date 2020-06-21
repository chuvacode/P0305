<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Models\LinkSiteToHost;

class AccessSite extends Model
{
    protected $fillable = [
        'title', 'site_url', 'comment',
        'admin_panel_url', 'admin_panel_login', 'admin_panel_password',
        'ftp_server', 'ftp_login', 'ftp_password',
        'db_server', 'db_name', 'db_login', 'db_password',
    ];

//    public function host() {
////        $host_id = $this->hasOne('LinkSiteToHost', 'site_id')->select('host_id');
//
//        return $this->hasOne('LinkSiteToHost', 'site_id');
//    }

    public function host()
    {
        return $this->hasOne('App\Models\LinkSiteToHost', 'site_id', 'id');
    }

    public function getHost()
    {
        $host = $this->hasOne('App\Models\LinkSiteToHost', 'site_id')->select('host_id')->first()->toArray();

        return $host;
    }
}
