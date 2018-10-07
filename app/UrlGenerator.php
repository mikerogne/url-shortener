<?php

namespace App;

class UrlGenerator
{
    public static function shortUrl(): string
    {
        return str_random(6);
    }
}
