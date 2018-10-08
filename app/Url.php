<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['compiled_url'];

    public function getRouteKeyName()
    {
        return 'short_url';
    }

    public function getCompiledUrlAttribute()
    {
        return url('/' . $this->short_url);
    }
}
