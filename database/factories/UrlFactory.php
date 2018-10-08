<?php

use Faker\Generator as Faker;

$factory->define(\App\Url::class, function (Faker $faker) {
    return [
        'long_url' => 'http://example.com/' . $faker->domainWord,
        'short_url' => str_random(6),
    ];
});
