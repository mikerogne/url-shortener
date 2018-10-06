<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ExpiredScope;

class Url extends Model
{

    protected $guarded = ['id'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ExpiredScope);
    }

}
