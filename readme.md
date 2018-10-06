## What is this?

This is the millionth (give or take) URL shortener app. Literally nothing special going on here. I just wanted to play around with some Laravel tests including in-memory sqlite and what not.

Fun little project. PR's welcome (hello, Hacktoberfest), but must include tests!

## Installation instructions

* `git clone git@github.com:mikerogne/url-shortener.git`
* `cp .env.example .env` and set up your .env-file
* `composer install`
* `php artisan key:generate`
* `yarn` and then `yarn dev` or `yarn prod`

## Contributing

Thinking of contributing? Awesome! Please only submit serious pull requests, not fluff for Hacktoberfest.

You can follow the above installation instructions, but make sure you clone your *fork* and not this repository.

And most importantly, **tests must be included!**
