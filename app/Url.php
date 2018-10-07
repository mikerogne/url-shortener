<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ExpiredScope;

class Url extends Model
{
    protected $guarded = ['id'];

    /**
     * The "booting" method of the model.
     */
    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new ExpiredScope);
    }

    /**
     * Create a Url by a url string.
     */
    public static function createFromUrl(string $url): Url
    {
        return static::create(['url' => $url]);
    }

    /**
     * Find a Url by it's slug, or fail.
     */
    public static function findBySlugOrFail(string $slug): Url
    {
        return static::findOrFail(static::slugToId($slug));
    }

    /**
     * Static function to convert any string to a base 10 version of itself.
     *
     * Used to convert the URL slug (domain.com/u/{slug}) to an integer
     * which we can then pass into Url::find() to look up the full url.
     */
    public static function slugToId($slug): int
    {
        return base_convert($slug, 36, 10);
    }

    /**
     * Converts the models ID to a base 36 string to shorten it
     */
    public function getSlugAttribute(): ?string
    {
        return $this->id ? base_convert($this->id, 10, 36) : null;
    }
}
