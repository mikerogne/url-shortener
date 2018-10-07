<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $guarded = ['id'];

    /**
     * Create a Url from just the long_url.
     */
    public static function createFromUrl(string $url): Url
    {
        return static::create(['long_url' => $url]);
    }

    /**
     * Create a new Url.
     *
     * We will auto-generate a short_url if none is provided.
     *
     * If we get a unique-constraint error from a short_url that has been
     * auto-generated, we will retry the method and regenerate.
     */
    public static function create(array $attributes = []): Url
    {
        try {
            return static::query()->create(
                array_merge($attributes, [
                    'short_url' => $attributes['short_url'] ?? UrlGenerator::shortUrl()
                ])
            );
        } catch (\Illuminate\Database\QueryException $e) {
            if (
                $e->errorInfo[2] === 'UNIQUE constraint failed: urls.short_url'
                && empty($attributes['short_url'])
            ) {
                return static::create($attributes);
            }

            throw $e;
        }
    }
}
