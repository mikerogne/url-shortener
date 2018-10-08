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

    /**
     * Converts the models ID to a base 36 string to shorten it
     *
     * @return string
     */
    public function getSlugAttribute() : string {
        return $this->id ? base_convert($this->id, 10, 36) : null;
    }

    /**
     * Static function to convert any string to a base 10 version of itself
     * Used to convert the URL slug (domain.com/u/{slug}) to an integer
     * which we can then pass into Url::find() to look up the full url
     *
     * @return int
     */
    public static function convert_slug_to_id($slug) : int {
        return base_convert($slug, 36, 10);
    }


}
