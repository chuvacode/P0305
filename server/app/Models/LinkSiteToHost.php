<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkSiteToHost extends Model
{
    protected $fillable = [
        'site_id', 'host_id'
    ];

    public $incrementing = false;

    protected $primaryKey = 'site_id';

//    public function host() {
//        return $this->belongsTo('App\Models\AccessHost', 'host_id', 'id')->select(['id', 'title']);
//    }
    public function host() {
        return $this->belongsTo('App\Models\AccessHost', 'host_id', 'id');
    }

//    public function site() {
//        return $this->belongsTo('App\Models\AccessSite', 'site_id', 'id')->select(['id', 'title']);
//    }
}
